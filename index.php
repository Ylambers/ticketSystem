<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/login_style.css">

    </head>
    <body>
    <!--Pulling Awesome Font -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-5 col-md-3">
                <form class="form-login" action="includes/login.php" method="post">
                    <h4>Welcome back.</h4>
                    <input type="email" id="userName" class="form-control input-sm chat-input" placeholder="email" name="email" />
                    </br>
                    <input type="password" id="userPassword" class="form-control input-sm chat-input" placeholder="password" name="password" />
                    </br>
                    <input type="submit" name="login"  class="btn btn-primary btn-md" value="Login"/>
                    <a href="register.php">
                        <input type="button" class="btn btn-primary btn-md" value="Registreren"/>
                    </a>
                </form>
            </div>
        </div>
    </div>

    </body>
</html>
