<?php

require 'includes/common.php';

$user_id = $_SESSION['id'];
$plan_id = $_GET['id'];
$title = mysqli_real_escape_string($con, $_POST['title']);
$date = mysqli_real_escape_string($con, $_POST['date']);
$amount_spent = mysqli_real_escape_string($con, $_POST['amount_spent']);
$person_name = mysqli_real_escape_string($con, $_POST['person_name']);
$bill = '';

$person_select_query = "SELECT * FROM persons WHERE plan_id = '$plan_id' AND name = '$person_name'";
$person_selection_result = mysqli_query($con, $person_select_query) or die(mysqli_error($con));
$row_person = mysqli_fetch_array($person_selection_result);
$person_id = $row_person["id"];

function GetImageExtension($imagetype) {
    if (empty($imagetype)) {
        return false;
    }
    switch ($imagetype) {
        case 'image/bmp': return '.bmp';
        case 'image/gif': return '.gif';
        case 'image/jpeg': return '.jpg';
        case 'image/png': return '.png';
        default: return false;
    }
}
if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name = $_FILES["uploadedimage"]["name"];
    $temp_name = $_FILES["uploadedimage"]["tmp_name"];
    $imgtype = $_FILES["uploadedimage"]["type"];
    $ext = GetImageExtension($imgtype);
    $imagename = date("d-m-Y") . "-" . time() . $ext;
    $target_path = "img/bill/" . $imagename;
    if (move_uploaded_file($temp_name, $target_path)) {
        $bill = $imagename;
    }
}
$insert_query = "insert into expenses(user_id, person_id, plan_id, name, date, amount_spent, bill) values ('$user_id', '$person_id', '$plan_id', '$title', '$date', '$amount_spent', '$bill')";
$insertion_result = mysqli_query($con, $insert_query) or die(mysqli_error($con));

header("location: view_plan.php?id=$plan_id");
?>
