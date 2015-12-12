<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 12-12-2015
 * Time: 11:12
 */

session_start();
session_destroy();


echo 'Je bent uitgelogt. <a href="../index.php">Ga terug!</a>';