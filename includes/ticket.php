<?php
/**
 * Created by PhpStorm.
 * User: Yaron
 * Date: 3-12-2015
 * Time: 18:17
 */
require_once('database.php');

    if (isset($_POST['ticket'])) {
        $problem = mysqli_real_escape_string($db, $_POST['problemname']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $user = mysqli_real_escape_string($db, $_POST['user_id']);

        $error = 0;

        if(strlen($problem) <= 5){$error++; echo "De korte omschrijving is te kort!". "<br />";}
        if(strlen($description) <= 20){$error++; echo "Graag meer als 20 tekens invoeren" . "<br/>";}

        if ($error == 0){
            $query = "INSERT INTO ticket (problemname, description, user_id) VALUES ('$problem', '$description', '$user')";

            if (!mysqli_query($db, $query)) {
                die('Error ' . mysqli_error($db));
            }
        }
        if(strlen($error) > 1){
            echo $error;
        }
    }

    echo '
        <form action="" method="post">
        <label>Korte Probleem beschrijving: </label> <br />
        <input type="text" name="problemname" id="problemname" value="'.$problem.'"> </input> </br>
        <label>Complete probleem beschrijving: </label> <br />
        <input type="text" name="description" id="description" value="'.$description.'"> </input> <br />
        <label>User</label> <br/>
        <input type="text" name="user_id" id="user_id"> </input> <br/>
        <input type="submit" name="ticket" value="toevoegen" />
        </form>
    ';


mysqli_close($db);

