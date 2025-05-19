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
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT); // Hash password for security
    $registration_date = $_POST['registration_date']; // User-provided date of registration

    // Check if the email already exists
    $sql_check = "SELECT * FROM users WHERE email = '$user_email'";
    $result_check = $conn->query($sql_check);
    
    if ($result_check->num_rows > 0) {
        $error = "Email is already registered!";
    } else {
        // Insert new user into the database
        $sql_insert = "INSERT INTO users (name, age, city, email, password, date_of_registration) 
                       VALUES ('$name', '$age', '$city', '$user_email', '$user_password_hash', '$registration_date')";
        
        if ($conn->query($sql_insert) === TRUE) {
            header("Location: login.php"); // Redirect to login page after registration
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Medical Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .register-container {
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
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="date"] {
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
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #084F08;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Register</h2>

    <?php if ($error != "") { echo "<p class='error'>$error</p>"; } ?>

    <form method="POST" action="" id="registrationForm">
        <input type="text" name="name" placeholder="Enter Full Name" required>
        <input type="number" name="age" placeholder="Enter Age" required>
        <input type="text" name="city" placeholder="Enter City" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <input type="date" name="registration_date" required>

        <button type="submit" name="register">Register</button>
    </form>

    <div class="login-link">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>

<script>
    document.getElementById("registrationForm").addEventListener("submit", function(e) {
        // Client-side validation (optional)
        const name = document.querySelector("input[name='name']").value;
        const age = document.querySelector("input[name='age']").value;
        const city = document.querySelector("input[name='city']").value;
        const email = document.querySelector("input[name='email']").value;
        const password = document.querySelector("input[name='password']").value;
        const registrationDate = document.querySelector("input[name='registration_date']").value;
        
        // Basic validation
        if (name === "" || age === "" || city === "" || email === "" || password === "" || registrationDate === "") {
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
