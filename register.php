<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<div class="menubar">
<a href="index.php">terug</a>
</div>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 12-12-2015
 * Time: 20:42
 */

$count = 0;

include_once('includes/database.php');

if (isset($_POST['register'])) {
    $count++;
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);

    $queryUsers = "SELECT * FROM user WHERE email='$email'";
    $resultUsers = mysqli_query($db, $queryUsers);
    $rowUsers = mysqli_fetch_array($resultUsers);
    $userEmail = $rowUsers['email'];

    $error = 0;
    if(strlen($firstname) < 3){$error++; echo '<div class="error">'.'* Voornaam is tekort'."</div>";}
    if(strlen($lastname) < 3){$error++; echo '<div class="error">'.'* Achternaam is tekort '."</div>";}
    if(strlen($phone) < 3){$error++; echo '<div class="error">'.'* Telefoonnummer is tekort'."</div>";}
    if(strlen($email) < 3){$error++; echo '<div class="error">'.'* Email adress is tekort '."</div>";}
    if(count($userEmail) > 0){$error++; echo '<div class="error">'.'* Email adres bestaat al'."</div>";}
    if($password != $password1){$error++; echo '<div class="error">'.'* De wachtwoorden zijn niet gelijk '."</div>";}
    if(strlen($password) <= 3){$error++; echo '<div class="error">'.'* Het wachtwoord is te kort '."</div>";}

    if($password == $password1){
        $pass = md5($password);
        $password = $pass;
    }

    if ($error == 0){
        $query = "INSERT INTO user (firstname, lastname, phone, email, password) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password')";
        if (!mysqli_query($db, $query)) {
            die('Error ' . mysqli_error($db));
        }else{
            echo 'U bent nu geregisteert';
            $count = 0;
        }
    }
    if(strlen($error) > 1){
        echo $error;
    }
}

if($count == 0){
    $firstname = '';
    $lastname = '';
    $phone = '';
    $email = '';
}

echo '
<div class="containerForm">
   <form role="form" method="post">
      <div class="form-group">
        <label for="firstname">Voornaam:</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="'.$firstname.'">

        <label for="firstname">Achternaam:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="'.$lastname.'">

        <label for="phone">Telefoonnummer:</label>
        <input type="text" class="form-control" id="phone" name="phone" value="'.$phone.'">

        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="'.$email.'">

        <label for="password">Wachtwoord:</label>
        <input type="password" class="form-control" id="password" name="password">

        <label for="password">Wachtwoord bevesteging:</label>
        <input type="password" class="form-control" id="password1" name="password1">

        <button type="submit" name="register" class="btn btn-default">Submit</button>
      </div>
    </form>
</div>
';