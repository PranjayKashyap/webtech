<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
    // Initialize an empty associative array to store user data
    $user_data = array();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and store user data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Perform basic validation
        if (strlen($name) >= 10 && filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[0-9]{10}$/', $phone) && strlen($address) >= 2 && preg_match('/^(?=.*[A-Z].*[A-Z])(?=.*[0-9])(?=.*[_@$]).{2,}$/', $password) && $password == $confirm_password) {
            // Store user data in the associative array
            $user_data["name"] = $name;
            $user_data["email"] = $email;
            $user_data["phone"] = $phone;
            $user_data["address"] = $address;
            $user_data["password"] = $password;

            echo "<p>User registration successful!</p>";

            // Print the user data (for demonstration purposes)
            echo "<pre>";
            print_r($user_data);
            echo "</pre>";
        } else {
            echo "<p>Invalid input. Please check your details and try again.</p>";
        }
    }
?>

<!-- User Registration Form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Registration</h2>

    <label for="name">Name (at least 10 characters):</label>
    <input type="text" name="name" required minlength="10">

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" name="phone" pattern="[0-9]{10}" required>

    <label for="address">Address (at least 2 characters):</label>
    <input type="text" name="address" required minlength="2">

    <label for="password">Password (at least 2 uppercase, 1 digit, 1 _@$):</label>
    <input type="password" name="password" required pattern="^(?=.*[A-Z].*[A-Z])(?=.*[0-9])(?=.*[_@$]).{2,}$">

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>

    <button type="submit">Register</button>
</form>

<!-- Link to the Login Page -->
<p>Already have an account? <a href="login.php">Login here</a>.</p>

</body>
</html>
