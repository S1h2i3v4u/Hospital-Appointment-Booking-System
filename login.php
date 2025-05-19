<?php
// Start the session
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";        
$password = "";            
$dbname = "medical"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submit
$error = "";
if (isset($_POST['login'])) {
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    // Simple query to check credentials
    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($user_password, $row['password'])) { // Verify the hashed password
            // Login success
            $_SESSION['email'] = $user_email;
            header("Location: home.php"); // Redirect after successful login
            exit();
        } else {
            $error = "Invalid Password!";
        }
    } else {
        $error = "Invalid Email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Medical Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            box-shadow: 0px 0px 10px gray;
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #084F08;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Ensures padding doesn't affect width */
        }
        button {
            background-color: #53AC33;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #4e8e34;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .register-link a {
            color: #084F08;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if ($error != "") { echo "<p class='error'>$error</p>"; } ?>

    <form method="POST" action="" id="loginForm">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <div class="register-link">
        <p>Don't have an account? <a href="registration.php">Register here</a></p>
    </div>
</div>

<script>
     document.getElementById("loginForm").addEventListener("submit", function(e) {
        // Client-side validation (optional)
        const email = document.querySelector("input[name='email']").value;
        const password = document.querySelector("input[name='password']").value;

        // Basic validation
        if (email === "" || password === "") {
            alert("Please fill in all fields.");
            e.preventDefault();
        }

        // Email validation
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!email.match(emailPattern)) {
            alert("Please enter a valid email address.");
            e.preventDefault();
        }
    });
</script>
</body>
</html>
