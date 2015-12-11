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


if(!empty($_SESSION['email'])){
    echo "Welkom terug ". $userName;;
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

    while($row = mysqli_fetch_array($resultTicket)){
        echo $row['created_at']. "<br/>";
        echo $rowUrgentieLevel['name'];
        echo $row['customer']. "<br/>";
        echo $row['description']. "<br/>";
        echo '<a href="tickethandeling.php?id='.$row['idticket'].'"> Behandelen </a> <br/>';
    }

}


mysqli_close($db);
