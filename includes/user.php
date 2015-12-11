<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 3-12-2015
 * Time: 19:24
 */
include_once('database.php');
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