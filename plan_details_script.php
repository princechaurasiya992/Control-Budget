<?php

require 'includes/common.php';

$user_id = $_SESSION['id'];
$title = mysqli_real_escape_string($con, $_POST['title']);
$from = mysqli_real_escape_string($con, $_POST['from']);
$to = mysqli_real_escape_string($con, $_POST['to']);
$initial_budget = mysqli_real_escape_string($con, $_POST['initial_budget']);
$no_of_people = mysqli_real_escape_string($con, $_POST['no_of_people']);

$plan_insert_query = "insert into plans(user_id, name, from_date, to_date, initial_budget, no_of_people) values ('$user_id', '$title', '$from', '$to', '$initial_budget', '$no_of_people')";
$plan_insertion_result = mysqli_query($con, $plan_insert_query) or die(mysqli_error($con));

$plan_id = mysqli_insert_id($con);

for ($i = 1; $i <= $no_of_people; $i++) {    
    
    $person_name = $_POST["person_$i"];
    $person_insert_query = "insert into persons(user_id, name, plan_id) values ('$user_id', '$person_name', '$plan_id')";
    $person_insertion_result = mysqli_query($con, $person_insert_query) or die(mysqli_error($con));
}
echo "<script>alert('Your new Budget Planner has been added successfully!')</script>";
echo ("<script>location.href='home.php'</script>");

?>
