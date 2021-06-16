<?php
require 'includes/common.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$initial_budget = $_POST['initial_budget'];
$person = $_POST['no_of_people'];

if ($initial_budget == null || $person == null) {
    header('location: create_new_plan.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Plan Details</title>
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
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <form method="POST", action="plan_details_script.php">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Title (Ex: Trip to Goa)" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6" float="left">
                                        <label for="from">From</label>
                                        <input type="date" min="2020-04-01" max="2020-09-30" class="form-control" name="from" placeholder="dd/mm/yyyy" required>
                                    </div>
                                    <div class="form-group col-sm-6" float="right">
                                        <label for="to">To</label>
                                        <input type="date" min="2020-04-01" max="2020-09-30" class="form-control" name="to" placeholder="dd/mm/yyyy" required>
                                    </div>
                                    <div class="form-group col-sm-8" float="left">
                                        <label for="initial_budget">Initial Budget</label>
                                        <input type="number" class="form-control" name="initial_budget" value="<?php $initial_budget ?>" placeholder="<?php echo $initial_budget; ?>"
                                               disabled>
                                        <input type="hidden" class="form-control" value="<?php echo $initial_budget; ?>" name="initial_budget">
                                    </div>
                                    <div class="form-group col-sm-4" float="right">
                                        <label for="no_of_people">No. of People</label>
                                        <input type="number" class="form-control" name="no_of_people" placeholder="<?php echo $person; ?>"
                                               disabled>
                                        <input type="hidden" class="form-control" value="<?php echo $person; ?>" name="no_of_people">
                                    </div>
                                </div>
                                <?php
                                for ($i = 1; $i <= $person; $i++) {
                                    ?>
                                    <div class="form-group">
                                        <label for="<?php echo "person_" . $i; ?>"><?php echo "Person " . $i; ?></label>
                                        <input type="text" class="form-control" name="<?php echo "person_" . $i; ?>" placeholder="Person <?php echo $i; ?> Name" required>
                                    </div>
                                    <?php
                                }
                                ?>
                                <button type="submit" name="submit" class="button btn btn-primary btn-block">Submit</button> 
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
