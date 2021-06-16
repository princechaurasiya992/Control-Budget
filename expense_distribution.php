<?php
require 'includes/common.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$plan_id = $_GET['id'];

$plan_select_query = "SELECT * FROM plans WHERE id = '$plan_id'";
$plan_selection_result = mysqli_query($con, $plan_select_query) or die(mysqli_error($con));
$row_plan = mysqli_fetch_array($plan_selection_result);

$person_select_query = "SELECT * FROM persons WHERE plan_id = '$plan_id'";
$person_selection_result = mysqli_query($con, $person_select_query) or die(mysqli_error($con));
$person_selection_result_2 = mysqli_query($con, $person_select_query) or die(mysqli_error($con));

$expense_select_query = "SELECT * FROM expenses WHERE plan_id = '$plan_id'";
$expense_selection_result = mysqli_query($con, $expense_select_query) or die(mysqli_error($con));

$expense_selection_result_2 = mysqli_query($con, $expense_select_query) or die(mysqli_error($con));
$all_expenses = 0;
$expense_person = 0;

while ($row_expense_2 = mysqli_fetch_array($expense_selection_result_2)) {
    $all_expenses = $all_expenses + $row_expense_2["amount_spent"];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Expense Distribution</title>
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
                            <div class="row">
                                <h4 class="text-center col-sm-10 col-xs-9"><?php echo $row_plan["name"]; ?></h4>                                            
                                <h4 class="text-right col-sm-2 col-xs-3"><span class = "glyphicon glyphicon-user"></span> <?php echo $row_plan["no_of_people"]; ?></h4>
                            </div>
                        </div>
                        <div class="panel-body"><br>
                            <div class="row">
                                <b><p class="col-xs-6">Initial Budget</p></b>
                                <b><p class="text-right col-xs-6">₹ <?php echo $row_plan["initial_budget"]; ?></p></b>
                            </div>
                            <?php
                            while ($row_person = mysqli_fetch_array($person_selection_result)) {
                                $expense_select_query_2 = "SELECT * FROM expenses WHERE person_id = '$row_person[id]'";
                                $expense_selection_result_3 = mysqli_query($con, $expense_select_query_2) or die(mysqli_error($con));
                                $expense_person = 0;
                                while ($row_expense_3 = mysqli_fetch_array($expense_selection_result_3)) {
                                    $expense_person = $expense_person + $row_expense_3["amount_spent"];
                                }
                                ?>
                                <div class="row">
                                    <b><p class="col-xs-6"><?php echo $row_person["name"]; ?></p></b>
                                    <p class="text-right col-xs-6">₹ <?php echo $expense_person; ?></p>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="row">
                                <b><p class="col-xs-6">Total Amount Spent</p></b>
                                <b><p class="text-right col-xs-6">₹ <?php echo $all_expenses; ?></p></b>
                            </div>
                            <div class="row">
                                <b><p class="col-xs-6">Remaining Amount</p></b>
                                <b><p class="text-right col-xs-6" style="color: <?php
                                    if (($row_plan["initial_budget"] - $all_expenses) < 0) {
                                        echo '#ff0000';
                                    } elseif (($row_plan["initial_budget"] - $all_expenses) > 0) {
                                        echo '#00cc00';
                                    } else {
                                        echo '#000000';
                                    }
                                    ?>"><?php
                                          if (($row_plan["initial_budget"] - $all_expenses) < 0) {
                                              echo "Overspent by ₹ " . abs(($row_plan["initial_budget"] - $all_expenses));
                                          } else {
                                              echo "₹ " . ($row_plan["initial_budget"] - $all_expenses);
                                          }
                                          ?></p></b>
                            </div>
                            <div class="row">
                                <b><p class="col-xs-6">Individual Shares</p></b>
                                <p class="text-right col-xs-6">₹ <?php echo $all_expenses / $row_plan["no_of_people"]; ?></p>
                            </div>
                            <?php
                            while ($row_person_2 = mysqli_fetch_array($person_selection_result_2)) {
                                $expense_select_query_3 = "SELECT * FROM expenses WHERE person_id = '$row_person_2[id]'";
                                $expense_selection_result_4 = mysqli_query($con, $expense_select_query_3) or die(mysqli_error($con));
                                $expense_person = 0;
                                while ($row_expense_4 = mysqli_fetch_array($expense_selection_result_4)) {
                                    $expense_person = $expense_person + $row_expense_4["amount_spent"];
                                }
                                ?>
                                <div class="row">
                                    <b><p class="col-xs-6"><?php echo $row_person_2["name"]; ?></p></b>
                                    <?php
                                    if ($expense_person - ($all_expenses / $row_plan["no_of_people"]) < 0) {
                                        echo '<p class="text-right col-xs-6" style="color: #ff5722">Owes ₹ ' . abs(($expense_person - ($all_expenses / $row_plan["no_of_people"]))) . '</p>';
                                    } elseif ($expense_person - ($all_expenses / $row_plan["no_of_people"]) > 0) {
                                        echo '<p class="text-right col-xs-6" style="color: #00cc00">Gets back ₹ ' . ($expense_person - ($all_expenses / $row_plan["no_of_people"])) . '</p>';
                                    } else {
                                        echo '<p class="text-right col-xs-6" style="color: #000000">All Settled Up</p>';
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?><br>                            
                            <center>
                                <a type="button" href="view_plan.php?id=<?php echo $plan_id; ?>" name="back" class="button btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Go back</a>
                            </center>
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
