<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 20-11-2015
 * Time: 12:01
 */

class Database{
    private $pdo;
    public function opendb(){

        $server = "localhost";
        $user = "root";
        $pass = "";
        $dbName = "ticketSystem";

       $this->pdo = new PDO(sprintf('mysql:host=%s;dbName=%s', $server, $dbName), $user, $pass);
    }

    public function users(){
        $includes = "/includes";
    }
}