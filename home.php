<?php
require 'includes/common.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
$user_id = $_SESSION['id'];
$select_plan_query = "SELECT * FROM plans WHERE user_id = '$user_id'";
$plan_selection_result = mysqli_query($con, $select_plan_query) or die(mysqli_error($con));

$select_user_query = "SELECT * FROM users WHERE id = '$user_id'";
$user_selection_result = mysqli_query($con, $select_user_query) or die(mysqli_error($con));
$row_user = mysqli_fetch_array($user_selection_result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
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
            <?php
            if (mysqli_num_rows($plan_selection_result) == 0) {
                ?>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <div class = "text-center">
                            <h3>Hi, <?php echo $row_user["name"]; ?>! Currently you don't have any active plans.</h3><br>
                            <div style="margin: 0px 50px 0px 50px" class="panel panel-default">
                                <div style="background-color: #ffffff; margin: 70px 0px 70px 0px;" class="panel-body">
                                    <a href="create_new_plan.php"><span class="glyphicon glyphicon-plus-sign"></span> Create a New Plan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <h3 style="margin-left: 20px;">Hi, <?php echo $row_user["name"]; ?>! Currently you have <?php echo mysqli_num_rows($plan_selection_result); ?> plans.</h3><br>
                <div class="row navbar-fixed-bottom">
                    <div style="margin-bottom: 100px;" class="col-md-1 col-md-offset-11 col-sm-2 col-sm-offset-10 col-xs-3 col-xs-offset-9">
                        <a href="create_new_plan.php"><span style="font-size:50px;" class="glyphicon glyphicon-plus-sign"></span></a>                        
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        while ($row_plan = mysqli_fetch_array($plan_selection_result)) {
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="panel panel-primary">
                                    <div style="height: 50px; padding-top: 5px;" class="panel-heading">
                                        <div class="row">
                                            <h4 class="text-center col-xs-9"><?php echo $row_plan["name"]; ?></h4>                                            
                                            <h4 class="text-right col-xs-3"><span class = "glyphicon glyphicon-user"></span> <?php echo $row_plan["no_of_people"]; ?></h4>
                                        </div>
                                    </div>
                                    <div class="panel-body"><br>
                                        <div class="row">
                                            <b><p class="col-xs-6">Budget</p></b>
                                            <p class="text-right col-xs-6">₹ <?php echo $row_plan["initial_budget"]; ?></p>
                                        </div>
                                        <div class="row">
                                            <b><p class="col-xs-2">Date</p></b>
                                            <p class="text-right col-xs-10"><?php
                                                if (date_format(date_create($row_plan["from_date"]), "Y") == date_format(date_create($row_plan["to_date"]), "Y")) {
                                                    echo date_format(date_create($row_plan["from_date"]), "jS M") . " - " . date_format(date_create($row_plan["to_date"]), "jS M Y");
                                                } else {
                                                    echo date_format(date_create($row_plan["from_date"]), "jS M Y") . " - " . date_format(date_create($row_plan["to_date"]), "jS M Y");
                                                }
                                                ?></p>
                                        </div>
                                        <a href="view_plan.php?id=<?php echo $row_plan["id"]; ?>" type="button" name="view" class="button btn btn-primary btn-block">View Plan</a>
                                    </div>
                                </div>
                            </div>                            
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>           
        </div>
        <?php
        include 'includes/footer.php';
        ?>
    </body>
</html>
