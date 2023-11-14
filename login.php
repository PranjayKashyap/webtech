<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
// Initialize a sample user for demonstration purposes
$sample_user = [
    'email' => 'user@example.com',
    'password' => 'password123',
];

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_email"]) && isset($_POST["login_password"])) {
    $login_email = $_POST["login_email"];
    $login_password = $_POST["login_password"];

    // Validate login credentials (for demonstration purposes)
    if ($login_email == $sample_user['email'] && $login_password == $sample_user['password']) {
        echo "<p>Login successful!</p>";
    } else {
        echo "<p>Login failed. Invalid email or password.</p>";
    }
}
?>

<!-- Login Form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Login</h2>

    <label for="login_email">Email:</label>
    <input type="email" id="login_email" name="login_email" required>

    <label for="login_password">Password:</label>
    <input type="password" id="login_password" name="login_password" required>

    <button type="submit">Login</button>
</form>

<!-- Link to the Registration Page -->
<p>Don't have an account? <a href="index.php">Register here</a>.</p>

</body>
</html>
