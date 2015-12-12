<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
<body>



<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 3-12-2015
 * Time: 18:17
 */
include_once('database.php');
session_start();
$email = $_SESSION['email'];
$user_email = "SELECT * FROM user WHERE email LIKE '%$email%'";
$result = mysqli_query($db, $user_email);
$row = mysqli_fetch_assoc($result);
$userName = $row['firstname'] ." ". $row['lastname']. "<br/>";

if(!empty($_SESSION['email'])){
    echo "<h2>"."Welkom terug ". $userName."</h2>";
    echo '<a href="logout.php">Uitloggen </a> ' . "<br/>";
}else{
    header('location: ../index.php');
}

$email = $_SESSION['email'];
$user_email = "SELECT * FROM user WHERE email LIKE '%$email%'";
$result = mysqli_query($db, $user_email);
$row = mysqli_fetch_assoc($result);
$userId = $row['id'];
$userRole = $row['role'];
$userName = $row['firstname'] ." ". $row['lastname']. "<br/>";


//User information

$problem = '';
$description = '';
if($userRole == 1){
    if (isset($_POST['ticket'])) {

        $description = mysqli_real_escape_string($db, $_POST['description']);
        $customerId = mysqli_escape_string($db ,$userId);
        $customerEmail = mysqli_escape_string($db, $_SESSION['email']);
        $importantLevel = mysqli_real_escape_string($db, $_POST['level']);

        $error = 0; /* Error is standaard 0 om door de check heen te komen */

        /* Validations */
        if(strlen($description) <= 20){$error++; echo "Graag meer als 20 tekens invoeren" . "<br/>";}

        if ($error == 0){
            $query = "INSERT INTO ticket (customer, description, idcustomer, urgentieLevel ) VALUES ('$customerEmail', '$description', '$customerId', '$importantLevel' )";
            if (!mysqli_query($db, $query)) {
                die('Error ' . mysqli_error($db));
            }else{
                $problem = '';
                $description = '';
            }
        }
        if(strlen($error) > 1){
            echo $error;
        }
    }

    echo '
        <form action="" method="post">
        <label>Probleem beschrijving: </label> <br />
        <input type="text" name="description" id="description" value="'.$description.'"> </input> <br />
        <label>Hoe dringend is het?</label>
        <select name="level">
        ';

    $queryUrgentieLevel = "SELECT * FROM urgentieLevel";
    $resultUrgentieLevel = mysqli_query($db, $queryUrgentieLevel);

    while($row = mysqli_fetch_array($resultUrgentieLevel)){
        echo '<option value="'.$row['id'].'"> '.$row['name'].' </option> ';
    }

    echo '
        </select>
        <input type="submit" name="ticket" value="toevoegen" />
        </form>
      ';
}

if($userRole == 2){
    $queryTicket = "SELECT * FROM ticket  ORDER BY created_at ";
    $resultTicket = mysqli_query($db, $queryTicket);

    $urgentieLevelQuery = "SELECT * FROM urgentieLevel";
    $returnUrgentieLevel = mysqli_query($db, $urgentieLevelQuery);
    $rowUrgentieLevel = mysqli_fetch_array($returnUrgentieLevel);
    $nameUrgentieLevel = $rowUrgentieLevel['name'];
    echo '
    <table class="table table-hover">
    <tr>
        <th>Datum</th>
        <th>Prioriteit</th>
        <th>Customer Email</th>
        <th>Description</th>
        <th>Behandelen</th>
    <tr>
    ';
    while($row = mysqli_fetch_array($resultTicket)){
        echo '<tr>';
        echo "<th>".$row['created_at']. "</th>";
        echo "<th>".$rowUrgentieLevel['name']. "</th>";
        echo "<th>".$row['customer']. "</th>";
        echo "<th>".$row['description']. "<th/>";
        echo '<a href="tickethandeling.php?id='.$row['idticket'].'"> Behandelen </a> <br/>';

        echo '</tr>';
    }
    echo '</table>';
}


mysqli_close($db);
