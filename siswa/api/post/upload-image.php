<?php

function uploadImage($fileName)
{
    $message = null;
    $target_dir = "../../assets/images/bukti-pembayaran/";
    $imageFileType = 'jpg';
    $target_file = $target_dir . $fileName . '.' . $imageFileType;
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $message =  "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $message =  "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $message =  "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $message =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message =  "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if  (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $message =  "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            $uploadOk = 0;
            $message =  "Sorry, there was an error uploading your file.";
        }
    }

    return array(
        "status" => $uploadOk ? 'success' : 'failed',
        "message" => $message
    );
}
