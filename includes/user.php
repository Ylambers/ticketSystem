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
$id = $row['id'];
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