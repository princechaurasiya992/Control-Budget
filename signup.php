<?php
require 'includes/common.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
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
                            <h4 class="text-center">Sign up</h4>
                        </div>
                        <div class="panel-body">                                          
                            <form method="POST" action="signup_script.php">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" minlength="1" placeholder="Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Valid Emaid" required
                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password (Min. 6 characters)" required
                                           pattern=".{6,}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number:</label>
                                    <input type="tel" class="form-control" name="phone" placeholder="Enter Valid Phone Number (Ex: 9044291375)" maxlength="10" required
                                           pattern="[0-9]{10}">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
