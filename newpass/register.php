<?php
include 'connect.php';
$error = [];
if(isset($_POST['register'])){
    $username = htmlspecialchars($_POST['name']);
    $pass = htmlspecialchars($_POST['pass']);
    $phone = htmlspecialchars($_POST['phone']);
    if(empty($username)){
      $error['user'] = 'Nhap username';
    }
    if(empty($pass)){
        $error['pass'] = 'Nhap pass';
    }
    if(empty($phone)){
        $error['phone'] = 'Nhap phone';
    }
    $sql = sprintf("SELECT * From bang1 where username ='%s'",$username);
    $result = $conn->query($sql);
    if($result->num_rows>0){
        $error['trungusername'] = 'User name da ton tai'; 
    }
    if(count($error) == 0){
        $pws_sha = sha1($pass);
        $sql = sprintf("INSERT INTO bang1 values('%s','%s','%s')",$username,$pws_sha,$phone);
        $result = $conn->query($sql);
        if($result){
            echo "Xin chao $username - $phone";
            header('location: login.php');
            exit(); 
        }else{
           die('loi insert'.$conn->error);
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
        Username <input type="text" name="name" placeholder="Username"> <br>
        PassWorld <input type="text" name="pass" placeholder="Passworld"> <br>
        Phone <input type="text" name="phone" placeholder="Nhap sdt"> <br>
        <input type="submit" value="Dang ki" name="register">
        <?php
        foreach($error as $key ){
          echo  "<p style='color:red;'>$key</p>";      
          }
        ?>
    </form>
</body>
</html>