<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Our MySQL user account.
define('MYSQL_USER', 'root');
 
//Our MySQL password.
define('MYSQL_PASSWORD', '');
 
//The server that MySQL is located on.
define('MYSQL_HOST', 'localhost');
 
//The name of our database.
define('MYSQL_DATABASE', 'ticketsystem');
 
/**
 * PDO options / configuration details.
 * I'm going to set the error mode to "Exceptions".
 * I'm also going to turn off emulated prepared statements.
 */
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
 
/**
 * Connect to MySQL and instantiate the PDO object.
 */
$pdo = new PDO(
    "mysql:localhost=" . MYSQL_HOST . ";ticketsystem=" . MYSQL_DATABASE, //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    $pdoOptions //Options
);