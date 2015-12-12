<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
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

if($role == 1){
    $queryUser = "SELECT * FROM user WHERE id='$id'";
    $resultUser = mysqli_query($db, $queryUser);
    $rowUser = mysqli_fetch_array($resultUser);

    if(isset($_POST['updateUser'])){
        $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        if(isset($_POST['level'])){
            $level = mysqli_real_escape_string($db, $_POST['level']);
        }else{ // wordt gebruikt wanneer account niet wordt aangepast
            $queryUser = "SELECT * FROM user WHERE id LIKE '%$id%'";
            $resultUser = mysqli_query($db, $queryUser);
            $rowUser = mysqli_fetch_array($resultUser);
            $level = $rowUser['role'];
        }

        $error = 0;

        if(strlen($firstname)<3){$error++; echo 'Graag een betere voornaam invoeren';}
        if(strlen($lastname)<3){$error++; echo 'Graag een betere achternaam invoeren';}
        if(strlen($phone)<3){$error++; echo 'Graag een beter telefoonnummer invoeren';}
        if(strlen($email)<3){$error++; echo 'Graag een beter emailadress invoeren';}

        if ($error == 0){
            $query = "UPDATE user SET firstname='$firstname', lastname='$lastname', phone='$phone',email='$email' WHERE id='$id'";
            if (!mysqli_query($db, $query)) {
                die('Error ' . mysqli_error($db));
            }else{
                header("Refresh:0");
            }
        }
    }

    echo '
    <form method="POST" role="form">
        <div class="form-group">
            <label>Voornaam</label>
            <input type="text" name="firstname" class="form-control" value="'.$rowUser['firstname'].'"> </input>
            <label>Achternaam</label>
            <input type="text" name="lastname" class="form-control" value="'.$rowUser['lastname'].'"> </input>
            <label>Telefoonnummer</label>
            <input type="text" name="phone" class="form-control" value="'.$rowUser['phone'].'"> </input>
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="'.$rowUser['email'].'"> </input>
            <input type="submit" class="btn btn-default" name="updateUser" value="update gebruiker" />
        </div>
    </form>
    ';
}