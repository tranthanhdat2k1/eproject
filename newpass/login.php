<?php
include 'connect.php';
$error = [];
if(isset($_POST['login'])){
    $username = htmlspecialchars($_POST['name']);
    $pass = htmlspecialchars($_POST['pass']);
    if(empty($username)){
       $error['name'] = 'Nhap username';
    }
    if(empty($pass)){
        $error['pass'] = 'Nhap pass';
    }
    if(count($error) == 0){
        $pass_hask = sha1($pass);
        $sql = sprintf("SELECT * from bang1 where username = '%s' and password_hash = '%s'",$username,$pass_hask);
        $result = $conn->query($sql);
        if($result->num_rows >0){
            echo 'XIn chao';
            exit();
        }else{
            $error['password'] = "Username hoac password khong dung";
        }
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
        Username <input type="text" name="name" placeholder="Username">
        Passworld <input type="text" name="pass" placeholder="Passworld">
        <input type="submit" value="Dang nhap" name="login">
        <?php
        foreach($error as $value){
          echo "$value";
        }
        ?>
    </form>
</body>
</html>