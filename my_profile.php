<?php
require 'includes/common.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
$user_id = $_SESSION['id'];
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
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="panel panel-default">
                        <div style="height: 50px; padding-top: 5px;" class="panel-heading text-center">
                            <h4>My Profile</h4>
                        </div>
                        <div class="panel-body">
                            <div class="thumbnail">
                                <h4>Profile Picture</h4>
                                <div style="margin: 0px 40px 0px 40px;" class="thumbnail">
                                    <?php
                                    if ($row_user["photo"] == null) {
                                        ?>
                                        <center><a href="create_new_plan.php"><span style="font-size:200px;" class="glyphicon glyphicon-user"></span></a></center>
                                        <?php
                                    } else {
                                        ?>
                                        <img src="img/profile/<?php echo $row_user["photo"]; ?>" alt="">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if ($row_user["photo"] == null) {
                                    ?>
                                    <form class="form-inline" method="POST" action="my_profile_script.php" enctype="multipart/form-data">
                                        <input type="file" class="form-control" name="uploadedimage">
                                        <button type="submit" name="upload" class="btn btn-default">Upload</button>
                                    </form>
                                    <?php
                                } else {
                                    ?>
                                    <br>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="thumbnail">
                                <h4>Profile Details</h4>
                                <p><b>Name: </b><?php echo $row_user["name"]; ?></p>
                                <p><b>Email: </b><?php echo $row_user["email_id"]; ?></p>
                                <p><b>Mobile Number: </b><?php echo $row_user["phone"]; ?></p>
                                <p><b>Registration Date: </b><?php echo date_format(date_create($row_user["registration_time"]), "jS M-Y"); ?></p>
                            </div>
                        </div>
                    </div> 
                    </a>
                </div>
            </div>   
        </div>
        <?php
        include 'includes/footer.php';
        ?>
    </body>
</html>
