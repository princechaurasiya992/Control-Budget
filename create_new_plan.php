<?php
require 'includes/common.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create New Plan</title>
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
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel panel-primary">
                        <div style="height: 50px; padding-top: 5px;" class="panel-heading">
                            <h4 class="text-center">Create New Plan</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST", action="plan_details.php">
                                <div class="form-group">
                                    <label for="initial_budget">Initial Budget</label>
                                    <input type="number" class="form-control" name="initial_budget" placeholder="Initial Budget (Ex: 4000)" min="50" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_of_people">How many people you want to add in your group?</label>
                                    <input type="number" class="form-control" name="no_of_people" placeholder="No. of people" min="1" required
                                           pattern="\d*">
                                </div>
                                <button type="submit" name="next" class="button btn btn-primary btn-block">Next</button> 
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
