<?php
/**
 * Created by PhpStorm.
 * User: yaronlambers
 * Date: 11/12/15
 * Time: 12:41
 */
include_once('database.php');
session_start();
$email = $_SESSION['email'];
$user_email = "SELECT * FROM user WHERE email LIKE '%$email%'";
$result = mysqli_query($db, $user_email);
$row = mysqli_fetch_assoc($result);
$userName = $row['firstname'] ." ". $row['lastname']. "<br/>";
$role = $row['role'];

if(!empty($_SESSION['email'])){
    echo "Welkom terug ". $userName;;
}else{
    header('location: ../index.php');
}
if ($role == 2){
    $id = $_GET['id'];
    $query = "SELECT * FROM ticket WHERE idticket='$id' ";
    $return = mysqli_query($db, $query);
    $row = mysqli_fetch_array($return);

    $urgentieLevelQuery = "SELECT * FROM urgentieLevel";
    $returnUrgentieLevel = mysqli_query($db, $urgentieLevelQuery);
    $rowUrgentieLevel = mysqli_fetch_array($returnUrgentieLevel);
    $nameUrgentieLevel = $rowUrgentieLevel['name'];

    $statusQ = "SELECT * FROM status";
    $returnStatus = mysqli_query($db, $statusQ);

    echo "Ticket aangemaakt op ".$row['created_at']."<br/>";
    echo "Maker ticked ".$row['customer']. "<br/>";
    echo "Prioriteid ".$nameUrgentieLevel. "<br/>";
    echo '
        <form action="" method="POST">
        <label> Ticket status </label>
        <select name="status" />
        ';


    while ($rowStatus = mysqli_fetch_array($returnStatus)){
        echo '
            <option name="'.$rowStatus['active'].'">'.$rowStatus['name'].' </option>
        ';
    }

    echo'
            </select>
            <label>Oplossing:</label>
            <input type="text" name="solution" />
            <input type="submit" name="submit" value="Verzenden">
        </form>
    ';

}
