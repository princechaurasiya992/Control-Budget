<?php

require 'includes/common.php';

$name = $_POST['name'];
if (strlen($name) == 0) {
    echo "<script>alert('Enter your name!')</script>";
    echo ("<script>location.href='signup.php'</script>");
}
$email = $_POST['email'];
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if (!preg_match($regex_email, $email)) {
    echo "<script>alert('Enter valid Email')</script>";
    echo ("<script>location.href='signup.php'</script>");
}
$password = $_POST['password'];
if (strlen($password) < 6) {
    echo "<script>alert('Enter correct Password')</script>";
    echo ("<script>location.href='signup.php'</script>");
}
$phone = $_POST['phone'];
if (strlen($phone) < 10) {
    echo "<script>alert('Invalid mobile number!')</script>";
    echo ("<script>location.href='signup.php'</script>");
}

$email = mysqli_real_escape_string($con, $email);
$name = mysqli_real_escape_string($con, $_POST['name']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$password = mysqli_real_escape_string($con, $password);
$secured_password = md5($password);

//This query is written just to check whether a user is already registered.
$user_select_query = "SELECT * FROM users WHERE email_id='$email'";
$user_select_result = mysqli_query($con, $user_select_query) or die(mysqli_error($con));
if (mysqli_num_rows($user_select_result) > 0) {
    echo "<script>alert('Email id already exists!')</script>";
    echo ("<script>location.href='signup.php'</script>");
} else {

    //Now, since the user is not registered before, so we insert the users information into database.
    $user_registration_query = "insert into users(email_id, name, phone, password, photo) values ('$email', '$name', '$phone', '$secured_password', '')";
    $user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
    $_SESSION['email'] = $email;
    $_SESSION['id'] = mysqli_insert_id($con);
    echo "<script>alert('You are successfully registered!')</script>";
    echo ("<script>location.href='home.php'</script>");
}
?>
