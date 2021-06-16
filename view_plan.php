<?php
require 'includes/common.php';
?>
<?php
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$plan_id = $_GET['id'];

$plan_select_query = "SELECT * FROM plans WHERE id = '$plan_id'";
$plan_selection_result = mysqli_query($con, $plan_select_query) or die(mysqli_error($con));
$row_plan = mysqli_fetch_array($plan_selection_result);

$person_select_query = "SELECT * FROM persons WHERE plan_id = '$plan_id'";
$person_selection_result = mysqli_query($con, $person_select_query) or die(mysqli_error($con));

$expense_select_query = "SELECT * FROM expenses WHERE plan_id = '$plan_id'";
$expense_selection_result = mysqli_query($con, $expense_select_query) or die(mysqli_error($con));

$expense_selection_result_2 = mysqli_query($con, $expense_select_query) or die(mysqli_error($con));
$all_expenses = 0;

while ($row_expense_2 = mysqli_fetch_array($expense_selection_result_2)) {
    $all_expenses = $all_expenses + $row_expense_2["amount_spent"];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Plan</title>
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
                <div class="col-lg-6 col-lg-offset-0 col-md-7 col-md-offset-0">
                    <div class="panel panel-primary">
                        <div style="height: 50px; padding-top: 5px;" class="panel-heading">
                            <div class="row">
                                <h4 class="text-center col-sm-10 col-xs-9"><?php echo $row_plan["name"]; ?></h4>                                            
                                <h4 class="text-right col-sm-2 col-xs-3"><span class = "glyphicon glyphicon-user"></span> <?php echo $row_plan["no_of_people"]; ?></h4>
                            </div>
                        </div>
                        <div class="panel-body"><br>
                            <div class="row">
                                <b><p class="col-xs-6">Budget</p></b>
                                <p class="text-right col-xs-6">₹ <?php echo $row_plan["initial_budget"]; ?></p>
                            </div>
                            <div class="row">
                                <b><p class="col-xs-6">Remaining Amount</p></b>
                                <p class="text-right col-xs-6" style="color: <?php
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
                                       ?></p>
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
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <?php
                            while ($row_expense = mysqli_fetch_array($expense_selection_result)) {
                                $person_select_query_2 = "SELECT * FROM persons WHERE id = '$row_expense[person_id]'";
                                $person_selection_result_2 = mysqli_query($con, $person_select_query_2) or die(mysqli_error($con));
                                $row_person_2 = mysqli_fetch_array($person_selection_result_2);
                                ?>
                                <div class="col-sm-6">
                                    <div class="panel panel-primary">
                                        <div style="height: 50px; padding-top: 5px;" class="panel-heading">
                                            <h4 class="text-center"><?php echo $row_expense["name"]; ?></h4>
                                        </div>
                                        <div class="panel-body"><br>
                                            <div class="row">
                                                <b><p class="col-xs-6">Amount</p></b>
                                                <p class="text-right col-xs-6">₹ <?php echo $row_expense["amount_spent"]; ?></p>
                                            </div>
                                            <div class="row">
                                                <b><p class="col-xs-6">Paid by</p></b>
                                                <p class="text-right col-xs-6"><?php echo $row_person_2["name"]; ?></p>
                                            </div>
                                            <div class="row">
                                                <b><p class="col-xs-6">Paid on</p></b>
                                                <p class="text-right col-xs-6"><?php echo date_format(date_create($row_expense["date"]), "jS M-Y"); ?></p>
                                            </div>
                                            <div class="row">
                                                <?php
                                                if ($row_expense["bill"] != null) {
                                                    ?>
                                                    <center><a href="img/bill/<?php echo $row_expense["bill"]; ?>" download="<?php echo $row_expense["name"]; ?>_bill_<?php echo $row_expense["date"]; ?>">Show Bill</a></center>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <center><a>You don't have Bill</a></center>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-5 col-md-offset-0">
                    <a type="button" href="expense_distribution.php?id=<?php echo $plan_id; ?>" name="expense_distribution" class="button btn btn-primary btn-lg">Expense Distribution</a><br><br><br><br>
                    <div class="panel panel-primary">
                        <div style="height: 50px; padding-top: 5px;" class="panel-heading">
                            <h4 class="text-center">Add New Expense</h4>
                        </div>
                        <div class="panel-body">                                          
                            <form id="view_plan_form" name="view_plan_form" method="POST" action="view_plan_script.php?id=<?php echo $plan_id; ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Expense Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" min="<?php echo $row_plan["from_date"]; ?>" max="<?php echo $row_plan["to_date"]; ?>" class="form-control" name="date" placeholder="dd/mm/yyyy" required>
                                    <div><?php
                                        if (isset($_GET['email_error'])) {
                                            echo $_GET['email_error'];
                                        }
                                        ?></div>
                                </div>
                                <div class="form-group">
                                    <label for="amount_spent">Amount Spent</label>
                                    <input type="number" class="form-control" name="amount_spent" placeholder="Amount Spent" min="0" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="person_name" name="person_name" required>
                                        <option>Choose the person</option>
                                        <?php
                                        while ($row_person = mysqli_fetch_array($person_selection_result)) {
                                            ?>
                                            <option><?php echo $row_person["name"]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="uploadedimage">Upload Bill</label>
                                    <input type="file" class="form-control" name="uploadedimage">
                                </div>
                                <button type="submit" name="add" onclick="return addFunction()" class="button btn btn-primary btn-block">Add</button>
                                <script>
                                    function addFunction() {
                                        if (document.getElementById("person_name").selectedIndex !== 0) {
                                            return true;
                                        } else {
                                            alert("Please select a Person!");
                                            return false;
                                        }
                                    }
                                </script>
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
