<?php
ob_start();
// If file upload form is submitted 
$status = $statusMsg = "";

if (isset($_POST["upload_img"])) {
    $status = 'error';
    if (!empty($_FILES["user_image"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["user_image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $user_image = $_FILES['user_image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($user_image));
            $id = getUserId($connection);
            // Insert image content into database 

            $isImageInDB = mysqli_query($connection, "SELECT * FROM user_images WHERE `user_id` = '" . $id . "'");
            $now = "NOW()";
            $isImageInDBArr = mysqli_fetch_array($isImageInDB);
            if (is_countable($isImageInDBArr) && count($isImageInDBArr) > 0) {
                $insert = mysqli_query($connection, "UPDATE `user_images` SET `user_id`='" . $id . "',`image`='" . $imgContent . "',`image_name`= $now WHERE `user_id` = '" . $id . "'");
            } else {
                $insert = mysqli_query($connection, "INSERT into user_images (user_id, image, image_name) VALUES ('" . $id . "','$imgContent', $now)");
            }

            if ($insert) {
                $status = 'success';
                header("Location: profile.php?status=success");
            } else {
                $statusMsg = "File upload failed, please try again.";
            }

        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select an image file to upload.';
    }
}

// Display status message 
if ($status != 'success' && $statusMsg != "") {
    echo "<div class='alert alert-danger my-1' id='img_info'> $statusMsg </div>";
}
?>