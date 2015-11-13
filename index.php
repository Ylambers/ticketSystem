<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form id="registratie" action="register.php" method="post">
            <fieldset
            <legend>Registratie</legend>
                <label for='name' >Voornaam*: </label>
                <input type='text' name='name' id='voornaam' maxlength="50" /></br>
                <label for='name' >Achternaam*: </label>
                <input type='text' name='name' id='achternaam' maxlength="50" /></br>
                <label for='email' >Email Addres*:</label>
                <input type='text' name='email' id='email' maxlength="50" /></br>
                <label for='password' >Wachtwoord*:</label>
                <input type='password' name='password' id='wachtwoord' maxlength="50" /></br>
                <input type='submit' name='Submit' value='Submit' />
            </fieldset>
        </form>
        
    </body>
</html>
