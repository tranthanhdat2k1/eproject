<?php
 $conn_taodb = new mysqli('localhost','root','',null);
 if($conn_taodb->connect_error){
 die("Ket noi that bai".$conn_taodb->connect_error);
 }
 $sql = "CREATE DATABASE IF NOT EXISTS newpass";
 $result = $conn_taodb->query($sql);
 if($result){
    echo 'tao database thanh cong';
 }else{
    die('ket noi that bai'.$conn_taodb->connect_error) ;
 }
 $conn_taodb->select_db('newpass');
 $sql = "CREATE TABLE IF NOT EXISTS bang1(
    username varchar(20) unique not null,
    password_hash varchar(40) not null,
    phone varchar(10)
 )";
 $result = $conn_taodb->query($sql);
 if($result){
    echo 'tao table thanh cong';
 }else{
    echo 'tao bang that bai'.$conn_taodb->connect_error ;
 }
 $conn_taodb->close();
 $conn = new mysqli('localhost','root','',"newpass");
?>