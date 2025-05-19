<?php
$host = "localhost";
$user = "root";
$password = ""; // Update if your MySQL password is not blank
$dbname = "medical";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $doctor_name = $_POST["doctor_name"];
    $time_slot = $_POST["time_slot"];
    $patient_name = $_POST["patient_name"];
    $contact_number = $_POST["contact_number"];

    $stmt = $conn->prepare("INSERT INTO appointments (doctor_name, time_slot, patient_name, contact_number) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $doctor_name, $time_slot, $patient_name, $contact_number);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Appointment booked successfully!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management</title>
    <style>
        :root {
            --primary-color: #084F08;
            --secondary-color: #53AC33;
            --text-color: #ffffff;
            --background-color: #f5f5f5;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
        }

        header {
            height: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: var(--text-color);
        }

        .logo img {
            height: auto;
            width: 100px;
            margin-right: 10px;
        }

        header nav a {
            color: var(--text-color);
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        .book-btn {
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .book-btn:hover {
            background-color: #45a049;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        .doctor-card {
            width: 20%;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: white;
            text-align: center;
        }

        .doctor-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .doctor-info h3 {
            font-size: 1rem;
            margin: 5px 0;
            font-weight: bold;
        }

        .doctor-info p {
            margin: 3px 0;
            color: #666;
        }

        @media (max-width: 768px) {
            .doctor-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="img/figma.logo.png" alt="Medical Team Logo">
    </div>
    <nav>
        <a href="home.php">Home</a>
        <a href="#book-appointment">Book Appointment</a>
        <a href="#about-us">About Us</a>
    </nav>
</header>

<section id="book-appointment" class="container">
    <h2>Book An Appointment</h2>
    <div class="doctor-cards">
        <?php
        $doctors = [
            ["img" => "img/dr0.jpg", "name" => "Dr. Sachin Katkade", "desc1" => "HOD Emergency Department", "desc2" => "Assistant Medical Superintendent"],
            ["img" => "img/dr1.jpg", "name" => "Dr. Vitthal Shendge", "desc1" => "HOD - Anaesthesia", "desc2" => "MBBS, DA, DNB, EDAIC"],
            ["img" => "img/dr2.jpg", "name" => "Dr. Kshitij Gaikwad", "desc1" => "Anaesthesia", "desc2" => "MBBS, DA"],
            ["img" => "img/dr3.jpg", "name" => "Dr. Smita Patil", "desc1" => "Anaesthesia", "desc2" => "MBBS, MD"]
        ];

        foreach ($doctors as $doc) {
            echo '
            <div class="doctor-card">
                <img src="' . $doc["img"] . '" alt="' . $doc["name"] . '">
                <div class="doctor-info">
                    <h3>' . $doc["name"] . '</h3>
                    <p>' . $doc["desc1"] . '</p>
                    <p>' . $doc["desc2"] . '</p>
                </div>
                <button class="book-btn" onclick="openBookingModal(\'' . addslashes($doc["name"]) . '\')">Book</button>
            </div>';
        }
        ?>
    </div>
</section>

<script>
    function openBookingModal(doctorName) {
        const timeSlot = prompt("Select a time slot for " + doctorName + ":\n(Example: 9:00 AM, 10:00 AM, etc.)");

        if (timeSlot) {
            const patientName = prompt("Enter your name:");
            const contactNumber = prompt("Enter your contact number:");

            if (patientName && contactNumber) {
                const formData = new FormData();
                formData.append('doctor_name', doctorName);
                formData.append('time_slot', timeSlot);
                formData.append('patient_name', patientName);
                formData.append('contact_number', contactNumber);

                fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert("Appointment booked successfully!\nQueue Position: " + Math.floor(Math.random() * 10 + 1));
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Failed to book appointment. Please try again.");
                });
            } else {
                alert("Please fill in all the details.");
            }
        }
    }
</script>
</body>
</html>
