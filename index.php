<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 20-11-2015
 * Time: 12:00
 */

include_once("includes/database.php");
$db = new Database();
$db->opendb();

?>


<h1>Login form</h1>
<form action="includes/users.php">
    Email:<br>
    <input type="email" name="Email">
    <br>
    Password:<br>
    <input type="password" name="lastname">
    <br><br>
    <input type="submit" value="Submit">
</form>