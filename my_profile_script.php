<?php

require 'includes/common.php';

$user_id = $_SESSION['id'];

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
    $target_path = "img/profile/" . $imagename;
    if (move_uploaded_file($temp_name, $target_path)) {
        $update_query = "UPDATE users SET photo = '$imagename' WHERE id = '$user_id'";
        $updation_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
        echo "<script>alert('Profile picture uploaded successfully!')</script>";
        echo ("<script>location.href='my_profile.php'</script>");
    }
} else {
    echo "<script>alert('Select an image, first!')</script>";
    echo ("<script>location.href='my_profile.php'</script>");
}
?>
