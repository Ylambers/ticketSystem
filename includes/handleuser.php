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

if(isset($_POST['updateUser'])){
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    if(isset($_POST['level'])){
        $level = mysqli_real_escape_string($db, $_POST['level']);
    }else{
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
            echo 'Gebruiker succesvol veranderd';
            $problem = '';
            $description = '';
        }
    }
}

$id = $_GET['id'];
$queryUser = "SELECT * FROM user WHERE id LIKE '%$id%'";
$resultUser = mysqli_query($db, $queryUser);
$rowUser = mysqli_fetch_array($resultUser);
$roleUser = $rowUser['role'];

echo '
<form action="" method="POST" >
    <label>Voornaam</label>
    <input type="text" name="firstname" value="'.$rowUser['firstname'].'"> </input>
    <label>Achternaam</label>
    <input type="text" name="lastname" value="'.$rowUser['lastname'].'"> </input>
    <label>Telefoonnummer</label>
    <input type="text" name="phone" value="'.$rowUser['phone'].'"> </input>
    <label>Email</label>
    <input type="text" name="email" value="'.$rowUser['email'].'"> </input>
';
    if($roleUser == 1){
        echo'<input type="radio" name="level" value="2"> Admin </input>';
    }elseif($roleUser == 2){
        echo '<input type="radio" name="level" value="1"> Gebruiker </input>';
    }else{
        echo '<input type="radio" name="level" value="1"> Gebruiker </input>';
    }
echo'


    <input type="submit" name="updateUser" value="update gebruiker" />
</form>
';

