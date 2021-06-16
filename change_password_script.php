<?php

require 'includes/common.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$email = $_SESSION['email'];
$old_password = mysqli_real_escape_string($con, $_POST['old_password']);
$new_password = mysqli_real_escape_string($con, $_POST['new_password']);
$re_type_new_password = mysqli_real_escape_string($con, $_POST['re_type_new_password']);
$secured_old_password = md5($old_password);
$secured_new_password = md5($new_password);

if (strlen($old_password) < 6) {
    echo "<script>alert('Old password is incorrect!')</script>";
    echo ("<script>location.href='settings.php'</script>");
} else if (strlen($new_password) < 6) {
    echo "<script>alert('Password length is too short!')</script>";
    echo ("<script>location.href='settings.php'</script>");
} else if ($new_password != $re_type_new_password) {
    echo "<script>alert('Password Mismatched!')</script>";
    echo ("<script>location.href='settings.php'</script>");
} else {
    $select_query = "SELECT * FROM users WHERE email_id = '$email' AND password = '$secured_old_password'";
    $selection_result = mysqli_query($con, $select_query) or die(mysqli_error($con));

    if (mysqli_num_rows($selection_result) > 0) {
        $update_query = "UPDATE users SET password = '$secured_new_password' WHERE email_id = '$email'";
        $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));

        session_destroy();
        echo "<script>alert('Your password has been changed successfully!')</script>";
        echo ("<script>location.href='index.php'</script>");
    } else {
        echo "<script>alert('Old password is incorrect!')</script>";
        echo ("<script>location.href='settings.php'</script>");
    }
}
?>
