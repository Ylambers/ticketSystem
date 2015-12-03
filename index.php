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
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);

    $query_user = "SELECT * FROM user WHERE username='".$username."' AND password='".$pass."' LIMIT 1";

    $runUser = mysqli_query($db, $query_user);
    $checkUser = mysqli_num_rows($runUser);

    if($checkUser > 0){
        $_SESSION['username'] = $username;
//        header('location: includes/ticket.php');
        echo "succes";
        include_once('includes/ticket.php');
    }
}

echo '
    <h1>Login form</h1>
    <form action="" method="post">

        Gebruikersnaam<br>
        <input type="text" name="username">
        <br>
        Password:<br>
        <input type="password" name="password">
        <br><br>
        <input type="submit" value="Submit" name="login">

    </form>
';
