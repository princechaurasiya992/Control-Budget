<?php

require 'includes/common.php';
$email = $_POST['email'];
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if (!preg_match($regex_email, $email)) {
    echo "<script>alert('Enter valid Email')</script>";
    echo ("<script>location.href='login.php'</script>");
}
$password = $_POST['password'];
if (strlen($password) < 6) {
    echo "<script>alert('Enter correct Password')</script>";
    echo ("<script>location.href='login.php'</script>");
}
$email = mysqli_real_escape_string($con, $email);
$password = mysqli_real_escape_string($con, $password);
$secured_password = md5($password);

//Here we are checking that the email id of the user is present in the database.
$query = "SELECT * FROM users WHERE email_id = '$email'";
$data = mysqli_query($con, $query) or die(mysqli_error($con));

if (mysqli_num_rows($data) > 0) {
    $row = mysqli_fetch_array($data);
    if ($secured_password == $row['password']) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email_id'];
        echo "<script>alert('You are logged in successfully!')</script>";
        echo ("<script>location.href='home.php'</script>");
    } else {
        echo "<script>alert('Password is incorrect!')</script>";
        echo ("<script>location.href='login.php'</script>");
    }
} else {
    echo "<script>alert('Provided email is not registered yet!')</script>";
    echo ("<script>location.href='login.php'</script>");
}
?>
