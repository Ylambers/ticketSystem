<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
