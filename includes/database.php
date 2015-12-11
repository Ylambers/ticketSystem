<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 20-11-2015
 * Time: 12:01
 */

    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "stenden_ehelp";
    $db = new mysqli($server, $user, $pass, $dbName);
    if ($db->connect_errno) {
        echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    }

    session_start();
    $email = $_SESSION['email'];
    $user_email = "SELECT * FROM user WHERE email LIKE '%$email%'";
    $result = mysqli_query($db, $user_email);
    $row = mysqli_fetch_assoc($result);
    $userName = $row['firstname'] ." ". $row['lastname']. "<br/>";









