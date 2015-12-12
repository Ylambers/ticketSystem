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

if(isset($_POST['updateUser'])){
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    $error = 0;
    if ($error == 0){
        $query = "UPDATE user SET firstname='$firstname', lastname='$lastname'', phone='$phone',email='$email'  WHERE id='$id'";
        if (!mysqli_query($db, $query)) {
            die('Error ' . mysqli_error($db));
        }else{
            $problem = '';
            $description = '';
        }
    }
}


$id = $_GET['id'];
$queryUser = "SELECT * FROM user WHERE id LIKE '%$id%'";
$resultUser = mysqli_query($db, $queryUser);
$rowUser = mysqli_fetch_array($resultUser);

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

    <input type="submit" name="updateUser" value="update gebruiker" />
</form>
';

