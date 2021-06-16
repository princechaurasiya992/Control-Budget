<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

session_destroy();
echo "<script>alert('You are successfully logged out!')</script>";
echo ("<script>location.href='index.php'</script>");
?>
