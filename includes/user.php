<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 3-12-2015
 * Time: 19:24
 */
include_once('database.php');
session_start();
$email = $_SESSION['email'];
$user_email = "SELECT * FROM user WHERE email LIKE '%$email%'";
$result = mysqli_query($db, $user_email);
$row = mysqli_fetch_assoc($result);
$userName = $row['firstname'] ." ". $row['lastname']. "<br/>";
$role = $row['role'];

if ($role == 2){
    $queryUser = "SELECT * FROM user";
    $resultUser = mysqli_query($db, $queryUser);

    while($rowUser = mysqli_fetch_array($resultUser)){
        echo $rowUser['firstname'] ."<br/>";
        echo $rowUser['lastname'] ."<br/>";
        echo $rowUser['phone'] ."<br/>";
        echo $rowUser['role'] ."<br/>";
        echo $rowUser['email']. "<br/>";
        echo '<a href="handleuser.php?id='.$rowUser['id'].'"> Behandelen </a> <br/>';
    }
}