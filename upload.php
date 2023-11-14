<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Upload</title>
</head>
<body>

<?php
$uploadDir = 'uploads/'; // Directory where uploaded resumes will be stored

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadFile = $uploadDir . basename($_FILES['resume']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if the file is a PDF
    if ($fileType != 'pdf') {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($uploadFile)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    // Check file size (you can adjust the size limit as needed)
    if ($_FILES['resume']['size'] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // If $uploadOk is set to 0, there was an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['resume']['tmp_name'], $uploadFile)) {
            echo "The file " . basename($_FILES['resume']['name']) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <label for="resume">Choose a PDF file:</label>
    <input type="file" name="resume" id="resume" accept=".pdf" required>
    <br>
    <input type="submit" value="Upload">
</form>

</body>
</html>
