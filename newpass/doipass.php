<?php
 include 'connect.php';
 $error = [];
 if(isset($_POST['doipass'])){
    $username = htmlspecialchars($_POST['name']);
    $pass = htmlspecialchars($_POST['pass']);
    $newpass = htmlspecialchars($_POST['newpass']);
    $cfm_newpass = htmlspecialchars($_POST['cfm_pass']);
    if(empty($username)){
        $error['name'] = 'Nhap username';
     }
     if(empty($pass)){
         $error['pass'] = 'Nhap pass';
     }  
     if(empty($newpass)){
        $error['newpass'] = 'Nhap newpass';
     }
     if(empty($pass)){
         $error['cfmpass'] = 'xac nhan pass';
     }
     if(count($error) < 1 ){
        $pass_hask = sha1($pass);
        $new_password_hash = sha1($newpass);
        $sql = sprintf("SELECT * from bang1 where username = '%s' and password_hash = '%s'",$username,$pass_hask);
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            if($newpass == $cfm_newpass){
                $sql = sprintf("UPDATE bang1 SET password_hash = '%s' where username = '%s' ",$new_password_hash,$username);
                echo "mat khau moi la $newpass";
                $result = $conn->query($sql);
                exit();
            }else{
                $error['ll'] = 'xac nhan mat khau k dung';
            }
           
        }else{
            $error['sai'] = "Tai khoan hoac mat khau khong dung";
        }
     }else{
        

     }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        username <input type="text" name="name">
        passworld_old <input type="text" name="pass">
        newpass <input type="text" name="newpass">
        cfm_pass <input type="text" name="cfm_pass">
        <input type="submit" name="doipass" value="Doi pass">
        <?php
        foreach($error as $value){
            echo "$value";
        }
        ?>
    </form>
</body>
</html>