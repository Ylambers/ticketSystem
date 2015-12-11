<?php

/**
 * Created by PhpStorm.
 * User: yaronlambers
 * Date: 11/12/15
 * Time: 12:41
 */
include_once('database.php');

if(!empty($_SESSION['email'])){
    echo "Welkom terug ". $userName;
    echo '<a href="ticket.php"> Alle tickets </a>' . "<br/>";
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
        if(strlen($ticketSolution <= 20)){$error++; echo "Graag een betere beschrijving ingeven! Minmaal 20 tekens" . "<br/>";}
        if(empty($ticketStatus)){$error++; echo "Graag een ticketstatus invoeren!". "<br/>";}

        $updateTicket = "UPDATE ticket SET solution='$ticketSolution', active='$ticketStatus', employee='$userName', fixed_at='$sqlDate'  WHERE idticket='$id'  ";
        if($error == 0){
            if (!mysqli_query($db, $updateTicket)) {
                die('Error ' . mysqli_error($db));
            }else {
                echo "Succesvol verzonden!";
                $ticketSolution = '';
            }
        }
    }

    echo "Ticket aangemaakt op ".$row['created_at']."<br/>";
    echo "Maker ticked ".$row['customer']. "<br/>";
    echo "Prioriteid ".$nameUrgentieLevel. "<br/>";
    echo "Beschrijving " .$row['description'] . "<br/>";
    echo "Oplossing " .$row['solution'] . "<br/>";
    echo "Tijdgefixt " .$row['fixed_at'] . "<br/>";
    echo '
        <form action="" method="POST">
        <label> Ticket status </label>
        <select name="status" />
        <option> </option>
        ';


    while ($rowStatus = mysqli_fetch_array($returnStatus)){
        echo '
            <option value="'.$rowStatus['active'].'">'.$rowStatus['name'].' </option>
        ';
    }


    echo'
            </select>
            <label>Oplossing:</label>
            <input type="text" name="solution" value="'.$ticketSolution.'" />
            <input type="submit" name="submit" value="Verzenden">
        </form>
    ';

}
