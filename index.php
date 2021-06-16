<?php
require 'includes/common.php';

if (isset($_SESSION['email'])) {
    header('location: home.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Control Budget</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body style="padding-top: 25px;">
        <?php
        include 'includes/header.php';
        ?>
        <div id='content'>
            <div id="banner-image">
                <div class= "container">
                    <center>
                        <div id="banner-content">
                            <h1>We help you control your budget</h1>
                            <a href="login.php" class ="btn btn-danger btn-lg active">Start Today</a>
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <?php
        include 'includes/footer.php';
        ?>
    </body>
</html>
