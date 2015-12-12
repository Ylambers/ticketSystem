<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
$role = $row['role'];
$id = $row['id'];

if(!empty($_SESSION['email'])){
    echo '<div class="menubar">';
    echo "<h2>"."Welkom ". $userName."</h2>"."<br/>";
    if($role == 2){
        echo '<a href="user.php">Gebruikers bekijken </a> ';
    }else{
        echo '<a href="user.php">Gegevens bewerken </a> ';
    }
    echo '<a href="logout.php">Uitloggen </a> ';
    echo '</div>';
}else{
    header('location: ../index.php');
}

/* Get session info */
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
                echo 'Probleem is toegevoegd en er wordt zo snel mogelijk naar gekeken';
                $problem = '';
                $description = '';
            }
        }
        if(strlen($error) > 1){
            echo $error;
        }
    }

    echo '
        <form action="" method="post" role="form">
        <div class="form-group">
            <label for="description">Probleem beschrijving: </label> <br />
            <textarea class="form-control" name="description" id="description"> '.$description.'</textarea>
            <div class="dropdown">
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
        <input class="btn btn-default" type="submit" name="ticket" value="toevoegen" />
        </div>
        </form>
      ';

    $allTickets = "SELECT * FROM ticket WHERE idcustomer='$id'";
    $queryAll = mysqli_query($db, $allTickets);
    echo '
    <table class="table table-hover">
    <tr>
        <th>Status</th>
        <th>Datum</th>
        <th>Aangemaakt op</th>
        <th>Beschrijving probleem</th>
        <th>Behandelaar</th>
        <th>Datum oplossing</th>
        <th>Beschrijving oplossing</th>
    <tr>
    ';
    while($rowAll = mysqli_fetch_array($queryAll)){
        if($rowAll['active'] == 0){
            $active = 'In de wachtrij';
        }elseif($rowAll['active'] == 1){
            $active = '<div class="progress"> '.'In behandeling';
        }elseif($rowAll['active'] == 3){
            $active = '<div class="done"> '.'Klaar'."</div>";
        }
        echo '<tr>';
        echo "<th>".$active ."</th>";
        echo "<th>".$rowAll['description'] ."</th>";
        echo "<th>".$rowAll['created_at'] ."</th>";
        echo "<th>".$rowAll['description'] ."</th>";
        if($rowAll['employee'] && $rowAll['fixed_at'] && $rowAll['solution'] == NULL){
            echo "<th>".'Er is nog geen oplossing'."</th>";
            echo "<th>".'-'."</th>";
            echo "<th>".'-'."</th>";
        }else{
            echo "<th>".$rowAll['employee'] ."</th>";
            echo "<th>".$rowAll['fixed_at'] ."</th>";
            echo "<th>".$rowAll['solution'] ."</th>";
        }
        echo '</tr>';
    }
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
        <th>Proces</th>
        <th>Prioriteit</th>
        <th>Customer Email</th>
        <th>Description</th>
        <th>Behandelen</th>
    <tr>
    ';
    while($row = mysqli_fetch_array($resultTicket)){

        if($row['active'] == 0){
            $active = 'In de wachtrij';
        }elseif($row['active'] == 1){
            $active = 'In behandeling';
        }elseif($row['active'] == 3){
            $active = 'Klaar';
        }

        if($row['urgentieLevel'] == 1){
            $urgentieLevel = 'Laag';
        }elseif($row['urgentieLevel'] == 2){
            $urgentieLevel = 'Normaal';
        }elseif($row['urgentieLevel'] == 4){
            $urgentieLevel = 'Kritiek';
        }

        echo '<tr>';
        echo "<th>".$row['created_at']. "</th>";
        echo "<th>" .$active."</th>";
        echo "<th>".$urgentieLevel. "</th>";
        echo "<th>".$row['customer']. "</th>";
        echo "<th>".$row['description']. "<th/>";
        echo '<a href="tickethandeling.php?id='.$row['idticket'].'"> Behandelen </a> <br/>';
        echo '</tr>';
    }
    echo '</table>';
}


mysqli_close($db);
