<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 20-11-2015
 * Time: 12:00
 */

session_start();
include_once("includes/database.php");

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);

    $query_user = "SELECT * FROM user WHERE email='".$email."' AND password='".$pass."' LIMIT 1";

    echo $query_user;
    $runUser = mysqli_query($db, $query_user);
    $checkUser = mysqli_num_rows($runUser);

    if($checkUser > 0){
        $_SESSION['email'] = $email;
        header('location: includes/ticket.php');
        echo "succes";
    }
}

echo '
    <h1>Login form</h1>
    <form action="" method="post">

        Gebruikersnaam<br>
        <input type="text" name="email">
        <br>
        Password:<br>
        <input type="password" name="password">
        <br><br>
        <input type="submit" value="Inloggen" name="login">

    </form>
';
