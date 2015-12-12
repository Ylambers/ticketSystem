<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>template</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
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
$id = $_GET['id'];
$role = $row['role'];


if(!empty($_SESSION['email'])){
    echo '<div class="menubar">';
    echo "<h2>"."Welkom ". $userName."</h2>"."<br/>";
    echo '<a href="ticket.php">Home </a> ';
    echo '<a class="menu" href="ticket.php"> Alle tickets </a>';
    echo '<a href="logout.php">Uitloggen </a>';
    echo '</div>';
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


    if(isset($_POST['submit'])){
        $error = 0; /* Error is standaard 0 om door de check heen te komen */

        $ticketStatus = mysqli_real_escape_string($db, $_POST['status']);
        $ticketSolution = mysqli_real_escape_string($db, $_POST['solution']);

        //String date timestamp
        $date = date("d.m.y");
        $sqlDate = date('d.m.y', strtotime($date));

        if(strlen($ticketSolution) < 10){$error++; echo "Graag een oplossing in voeren! Minimaal 10 tekens". "<br/>";}
        if(empty($ticketStatus)){$error++; echo "Graag een ticketstatus invoeren!". "<br/>";}

        $updateTicket = "UPDATE ticket SET solution='$ticketSolution', active='$ticketStatus', employee='$userName', fixed_at='$sqlDate'  WHERE idticket='$id'  ";
        if($error == 0){
            if (!mysqli_query($db, $updateTicket)) {
                die('Error ' . mysqli_error($db));
            }else {
                header("Refresh:0");
            }
        }
    }

    echo '
    <table class="table table-hover">
     <tr>
        <th>Ticket aangemaakt op </th>
        <th>Maker ticked</th>
        <th>Prioriteit</th>
        <th>Beschrijving </th>
        <th>Oplossing </th>
        <th>Tijdgefixt </th>
        <th>Behandelaar</th>
    </tr>
    ';
    echo '<tr>';
    echo "<th>".$row['created_at']."</th>";
    echo "<th>".$row['customer']. "</th>";
    echo "<th>".$nameUrgentieLevel. "</th>";
    echo "<th>".$row['description'] . "</th>";
    echo "<th>" .$row['solution'] . "</th>";
    echo "<th>" .$row['fixed_at'] . "</th>";
    echo "<th>" .$row['employee'] . "</th>";

    echo '</tr>';
    echo '
        <div class="containerForm">
        <form method="POST">
         <label>Oplossing</label> <br/>
         <textarea class="form-control" name="solution" rows="" cols="100">  </textarea> <br/>
        <label> Ticket status </label>
        <select name="status" class="form-control"/>
        <option>  </option>
        ';
    echo '</tr>';
    while ($rowStatus = mysqli_fetch_array($returnStatus)){
        echo '
            <option value="'.$rowStatus['active'].'">'.$rowStatus['name'].' </option>
        ';
    }
    echo'
            </select>

            <input class="btn btn-default" type="submit" name="submit" value="Verzenden"> <br/>
        </form>
        <br/>
        </div>
    ';

}
