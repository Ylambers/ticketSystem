<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
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
    $roleName = 'Admin';
}elseif($role == 1){
    $roleName = 'Gebruiker';
}

if(!empty($_SESSION['email'])){
    echo "<h2>"."Welkom terug ". $userName."</h2>";
    echo '<a href="ticket.php">Terug </a> ' . "<br/>";
    echo '<a href="logout.php">Uitloggen </a> ' . "<br/>";
}else{
    header('location: ../index.php');
}

if ($role == 2){
    $queryUser = "SELECT * FROM user";
    $resultUser = mysqli_query($db, $queryUser);

    echo '
     <table class="table table-hover">
    <tr>
        <th>Voornaam</th>
        <th>Achternaam</th>
        <th>Email</th>
        <th>telefoon</th>
        <th>Rechten</th>
        <th>Aanpassen</th>
    <tr>
    ';
    while($rowUser = mysqli_fetch_array($resultUser)){
        echo '<tr>';
            echo '<th>'.$rowUser['firstname'] ."</th>";
            echo '<th>'.$rowUser['lastname'] ."</th>";
            echo '<th>'.$rowUser['email']. "</th>";
            echo '<th>'.$rowUser['phone'] ."</th>";
            echo '<th>'.$roleName."</th>";
            echo '<th>'.'<a href="handleuser.php?id='.$rowUser['id'].'"> Aanpassen </a> </th>';
        echo '</tr>';
    }
}