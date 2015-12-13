<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 12-12-2015
 * Time: 11:15
 */
session_start();
include_once("database.php");

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, md5($_POST['password']));

    $query_user = "SELECT * FROM user WHERE email='".$email."' AND password='".$pass."' LIMIT 1";

    $runUser = mysqli_query($db, $query_user);
    $checkUser = mysqli_num_rows($runUser);

    if($checkUser > 0){
        $_SESSION['email'] = $email;
        header('location: ticket.php');
    }else{
        header("Refresh:0; url=../index.php");
    }
}