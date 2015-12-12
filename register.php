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
    if(strlen($firstname) < 3){$error++; echo' De Voornaam is te kort!'."<br/>" ;}
    if(strlen($lastname) < 3){$error++; echo' De achternaam is te kort!'."<br/>";}
    if(strlen($phone) < 3){$error++; echo' Het telefoonnummer is te kort!'."<br/>";}
    if(strlen($email) < 3){$error++; echo' Het emailadres is te kort!'."<br/>";}
    if(count($userEmail) > 0){$error++; echo 'Dit email adres bestaat al!' ."<br/>";}
    if($password != $password1){$error++; echo'De wachtwoorden zijn niet gelijk!'."<br/>";}

    if($password == $password1){
        $pass = md5($password.$email.rand(1,999));
        $password = $pass;
    }

    if ($error == 0){
        $query = "INSERT INTO user (firstname, lastname, phone, image, email, password) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password' ,'$password1')";
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
        <input type="password" class="form-control" id="password" name="password1">

        <button type="submit" name="register" class="btn btn-default">Submit</button>
      </div>
    </form>
';