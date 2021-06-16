<?php
require 'includes/common.php';

if (isset($_SESSION['email'])) {
    header('location: home.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log in</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>
        <div class="container" id="content">            
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="panel panel-default">
                        <div style="background-color: #ffffff;" class="panel-heading">
                            <h4 class="text-center">Login</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST", action="login_script.php">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required
                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password (Min. 6 characters)" required
                                           pattern=".{6,}">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button> 
                            </form>
                        </div>
                        <div class="panel-footer">
                            <p>Don't have an account? <a href="signup.php">Click here to Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <?php
        include 'includes/footer.php';
        ?>
    </body>
</html>
