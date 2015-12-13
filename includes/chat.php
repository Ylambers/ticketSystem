<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 13-12-2015
 * Time: 14:53
 */

include_once('database.php');
session_start();
$email = $_SESSION['email'];
$user_email = "SELECT * FROM user WHERE email LIKE '%$email%'";
$result = mysqli_query($db, $user_email);
$row = mysqli_fetch_assoc($result);
$userName = $row['firstname'] ." ". $row['lastname']. "<br/>";
$role = $row['role'];
$id = $row['id'];
if ($role == 2){
    $roleName = 'Admin';
}elseif($role == 1){
    $roleName = 'Gebruiker';
}


if(!empty($_SESSION['email'])){
    echo '<div class="menubar">';
    echo "<h2>"."Welkom ". $userName."</h2>"."<br/>";
    echo '<a href="ticket.php">Home </a> ';
    echo '<a class="menu" href="ticket.php"> Alle tickets </a>';
    echo '<a href="logout.php">Uitloggen </a>';
    echo '</div>';
}else{
    header('location: ../index.php');
}

$chatId = $_GET['id'];
$chatQuery = "SELECT * FROM ticket WHERE idticket='$chatId'";
$chatResult = mysqli_query($db, $chatQuery);
$row = mysqli_fetch_array($chatResult);
$idCustomer = $row['idcustomer'];

$userQuery = "SELECT * FROM user WHERE id='$idCustomer'";
$userResult = mysqli_query($db, $userQuery);
$rowUser = mysqli_fetch_array($userResult);
$time = date('Y-m-d H:i');

if(isset($_POST['chat'])){
    $message = mysqli_real_escape_string($db, $_POST['message']);
    $query = "INSERT INTO chat (message, user_id, ticket_id, post_time) VALUES ('$message', '$idCustomer', '$chatId', '$time')";
    if (!mysqli_query($db, $query)) {
        die('Error ' . mysqli_error($db));
    }else{
        echo 'Verzonden';
    }
}

echo '
    <form action="" method="post" role="form">
    <div class="form-group">
        <textarea class="form-control" name="message" rows="10" placeholder="Verstuur een bericht"></textarea>
        <input type="submit" class="form-control" name="chat" value="verzend" />
    ';

$queryMSg = "SELECT * FROM chat WHERE  ticket_id='$chatId' ORDER BY post_time DESC LIMIT 15";
$msgResult = mysqli_query($db, $queryMSg);
$rowinfoUser = mysqli_fetch_array($msgResult);
$idUser = $rowinfoUser['user_id'];



$chatUserId = "SELECT * FROM user WHERE id='$idUser'";
$chatUserIdResult = mysqli_query($db, $chatUserId);
$rowChatUserIdResult = mysqli_fetch_array($chatUserIdResult);
$nameUser = $rowChatUserIdResult['firstname'];


    echo '
        <div class="chat">
    ';
    echo "Je praat met " . $rowUser['firstname'] . " " . $rowUser['lastname'] . "<br/>";
    while ($row = mysqli_fetch_array($msgResult)) {
        echo '<div class="time"> ';
        echo $row['post_time']. ".<br/>";
        echo $nameUser;
        echo '</div>';
        echo $row['message']."<br/>";


    }
    echo '

        </div>
    ';



