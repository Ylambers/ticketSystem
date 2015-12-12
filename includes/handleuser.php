<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
<a href="user.php">Terug</a>
<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 11-12-2015
 * Time: 23:29
 */

include_once('database.php');
session_start();
$email = $_SESSION['email'];
$user_email = "SELECT * FROM user WHERE email LIKE '%$email%'";
$result = mysqli_query($db, $user_email);
$row = mysqli_fetch_assoc($result);
$userName = $row['firstname'] ." ". $row['lastname']. "<br/>";
$id = $_GET['id'];
$role = $row['role'];

if($role == 2){
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
            $query = "UPDATE user SET firstname='$firstname', lastname='$lastname', phone='$phone',email='$email', role='$level' WHERE id='$id'";
            if (!mysqli_query($db, $query)) {
                die('Error ' . mysqli_error($db));
            }else{
                header("Refresh:0");
            }
        }
    }

    $id = $_GET['id'];
    $queryUser = "SELECT * FROM user WHERE id LIKE '%$id%'";
    $resultUser = mysqli_query($db, $queryUser);
    $rowUser = mysqli_fetch_array($resultUser);
    $roleUser = $rowUser['role'];
    // Formulier user eddit
    echo '
<form action="" method="POST" role="form">
  <div class="form-group">
    <label>Voornaam</label>
    <input type="text" name="firstname" class="form-control" value="'.$rowUser['firstname'].'"> </input>
    <label>Achternaam</label>
    <input type="text" name="lastname" class="form-control" value="'.$rowUser['lastname'].'"> </input>
    <label>Telefoonnummer</label>
    <input type="text" name="phone" class="form-control" value="'.$rowUser['phone'].'"> </input>
    <label>Email</label>
    <input type="text" name="email" class="form-control" value="'.$rowUser['email'].'"> </input>
';
    if($roleUser == 1){
        echo'
            <div class="checkbox">
                <label><input type="radio" class="form-control" name="level" value="2"> Admin </input></label>
            </div>
            ';
    }elseif($roleUser == 2){
        echo '
            <div class="checkbox">
                <label><input type="radio" class="form-control" name="level" value="1"> Gebruiker </input></label>
            </div>
            ';
    }else{
        echo '
            <div class="checkbox">
                <label><input type="radio" class="form-control" name="level" value="1"> Gebruiker </input></label>
            </div>
            ';
    }
    echo'
    <input type="submit" class="btn btn-default" name="updateUser" value="update gebruiker" />
    </div>
</form>
';

}


