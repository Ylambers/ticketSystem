<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 20-11-2015
 * Time: 12:01
 */

$server = "localhost";
$user = "root";
$pass = "";
$dbName = "stenden_ehelp";

$db = new mysqli($server, $user, $pass, $dbName);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
