<?php
require 'includes/common.php';

if (!isset($_SESSION['email'])) {
 header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Settings</title>
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
            <div class="row row_style">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="panel panel-default">
                        <div style="background-color: #ffffff;" class="panel-heading">
                            <h4 class="text-center">Change Password</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="change_password_script.php">
                                <div class="form-group">
                                    <label for="old_password">Old Password:</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="Old Password" required="true"
                                           pattern=".{6,}">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password:</label>
                                    <input type="password" class="form-control" name="new_password" placeholder="New Password (Min. 6 characters)" required="true"
                                           pattern=".{6,}">
                                </div>
                                <div class="form-group">
                                    <label for="re_type_new_password">Confirm New Password:</label>
                                    <input type="password" class="form-control" name="re_type_new_password" placeholder="Re-type New Password" required="true"
                                           pattern=".{6,}">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Change</button>
                            </form>                         
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
