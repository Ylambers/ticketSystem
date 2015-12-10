<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 3-12-2015
 * Time: 18:17
 */
include_once('database.php');
session_start();
if(!empty($_SESSION['username'])){
    echo "Welkom terug ". $_SESSION['username'];
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
        $importantLevel = mysqli_real_escape_string($db, $_POST['importantlevel']);
        $customerId = $userId;
        $customerEmail = $_SESSION['email'];

        $error = 0; /* Error is standaard 0 om door de check heen te komen */
        /* Validations */
        if(strlen($description) <= 20){$error++; echo "Graag meer als 20 tekens invoeren" . "<br/>";}

        if ($error == 0){
            $query = "INSERT INTO ticket (customor, importantlevel, description, idcustomer, ) VALUES ('$customerEmail', '$importantLevel', '$description', '$customerId' )";
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
        <label>Hoe belangrijk is het?</label></br>
        <select name="importantlevel">
            <option name="normaal">Normaal</option>
            <option value="Belangrijk">Belangrijk</option>
            <option value="Dringend">Dringend</option>
        </select>
        <input type="submit" name="ticket" value="toevoegen" />
        </form>
    ';


mysqli_close($db);
