Create a MySQL Database:
Create a MySQL database named user_authentication and a table named users with columns id, username, password, and email.

PHP Code:

config.php - Database Configuration:

php
Copy code
<?php
$host = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$database = "user_authentication";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

signup.php - Signup Page:

php
Copy code
<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<html>
<head>
    <title>Signup</title>
</head>
<body>
    <h2>Signup</h2>
    <form action="" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Email: <input type="email" name="email" required><br>
        <input type="submit" value="Signup">
    </form>
</body>
</html>
login.php - Login Page:

php
Copy code
<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: upload_photo.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}
?>

<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
upload_photo.php - Photo Upload and PDF Conversion Page:

php
Copy code
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is a valid image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size (you can adjust the size limit as needed)
    if ($_FILES["photo"]["size"] > 5000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // If $uploadOk is set to 0, there was an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Convert the uploaded image to PDF (You may need to install additional libraries for this)
            // Example: Use Imagick library
            $imagick = new \Imagick();
            $imagick->readImage($targetFile);
            $imagick->setImageFormat("pdf");
            $imagick->writeImages("output.pdf", false);

            echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded and converted to PDF.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<html>
<head>
    <title>Upload Photo</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="photo">Choose a photo (less than 5KB):</label>
        <input type="file" name="photo" id="photo" accept="image/*" required>
        <br>
        <input type="submit" name="submit" value="Upload and Convert to PDF">
    </form>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
logout.php - Logout Page:

php
Copy code
<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>
Additional Notes:

Make sure to create the uploads directory with appropriate write permissions.
Install the Imagick library for PHP (sudo apt-get install php-imagick for Linux, or use an alternative method for your operating system).
Remember to adjust the database connection details in the config.php file, and install any required libraries for image to PDF conversion based on your server environment. This example uses Imagick, but you can explore other libraries based on your needs.


