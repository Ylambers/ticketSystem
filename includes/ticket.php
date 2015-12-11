<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 3-12-2015
 * Time: 18:17
 */
include_once('database.php');
session_start();

if(!empty($_SESSION['email'])){
    echo "Welkom terug ". $_SESSION['email'];
}else{
    header('location: ../index.php');
}

$email = $_SESSION['email'];
$user_email = "SELECT * FROM user WHERE email LIKE '%$email%'";
$result = mysqli_query($db, $user_email);
$row = mysqli_fetch_assoc($result);
$userId = $row['id'];

$problem = '';
$description = '';
    if (isset($_POST['ticket'])) {

        $description = mysqli_real_escape_string($db, $_POST['description']);
        $customerId = mysqli_escape_string($db ,$userId);
        $customerEmail = mysqli_escape_string($db, $_SESSION['email']);

        $error = 0; /* Error is standaard 0 om door de check heen te komen */

        /* Validations */
        if(strlen($description) <= 20){$error++; echo "Graag meer als 20 tekens invoeren" . "<br/>";}

        if ($error == 0){
            $query = "INSERT INTO ticket (customer, description, idcustomer ) VALUES ('$customerEmail', '$description', '$customerId' )";
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
        <input type="submit" name="ticket" value="toevoegen" />
        </form>
    ';


mysqli_close($db);
