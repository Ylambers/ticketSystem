
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/bootstrap.css">

<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 12-12-2015
 * Time: 11:12
 */

session_start();
session_destroy();
header("Refresh:0; url=../index.php");