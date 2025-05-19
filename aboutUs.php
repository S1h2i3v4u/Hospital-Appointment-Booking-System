<?php
// Optional: Database connection
// Replace with your actual database credentials
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


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <style>
     :root {
        --primary-color: #084F08;
        --secondary-color: #53AC33;
        --text-color: #ffffff;
        --background-color: #f5f5f5;
      }

      header {
        height: 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        color: var(--text-color);
      }

      .logo img {
        padding-top: 10px;
        height: auto;
        width: 100px;
        margin-right: 10px;
      }

      header nav a {
        color: var(--primary-color);
        text-decoration: none;
        margin: 0 15px;
        font-size: 18px;
        cursor: pointer;
      }

      header .login-btn {
        background-color: var(--primary-color);
        color: var(--text-color);
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

    /* Main Content */
    .about-section, .team-section {
      padding: 50px 20px;
      text-align: center;
      background: linear-gradient(135deg, #ffffff, #e3f2fd);
      margin: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp 1s ease-in-out forwards;
    }

    .about-section h2, .team-section h2 {
      font-size: 2rem;
      color: var(--primary-color);
      margin-bottom: 20px;
      position: relative;
    }

    .about-section h2::after, .team-section h2::after {
      content: '';
      width: 80px;
      height: 4px;
      background: var(--secondary-color);
      display: block;
      margin: 10px auto;
    }

    .about-section p {
      font-size: 1.1rem;
      line-height: 1.8;
      max-width: 800px;
      margin: 0 auto;
    }

    /* Team Section */
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 20px;
    }

    .team-member {
      background-color: var(--background-color);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .team-member:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .team-member img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 15px;
      object-fit: cover;
      animation: bounceIn 1s ease-in-out;
    }

    /* Footer */
    footer {
      background-color: var(--primary-color);
      color: var(--text-color);
      text-align: center;
      padding: 20px;
      margin-top: 50px;
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes bounceIn {
      0% {
        transform: scale(0.5);
        opacity: 0;
      }
      80% {
        transform: scale(1.1);
      }
      100% {
        transform: scale(1);
        opacity: 1;
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
      <a href="Appointment.php">Book Appointment</a>
      <a href="#specialties">Specialties</a>
      <a href="aboutUs.php">About Us</a>
      <a href="tips.html.php">Health Tips</a>
      <button class="login-btn">Login</button>
    </nav>
  </header>

  <!-- About Section -->
  <section class="about-section">
    <h2>Who We Are</h2>
    <p>We are a team of dedicated professionals committed to providing the best healthcare solutions...</p>
  </section>

  <!-- Team Section -->
  <section class="team-section">
    <h2>Meet Our Team</h2>
    <div class="team-grid">
      <div class="team-member">
        <img src="img/dr5.jpg" alt="Team Member 1">
        <h3>Dr. John Doe</h3>
        <p>Chief Medical Officer</p>
      </div>
      <div class="team-member">
        <img src="img/dr2.jpg" alt="Team Member 2">
        <h3>Jane Smith</h3>
        <p>Head of Operations</p>
      </div>
      <div class="team-member">
        <img src="img/dr3.jpg" alt="Team Member 3">
        <h3>Michael Brown</h3>
        <p>Lead Developer</p>
      </div>
      <div class="team-member">
        <img src="img/dr1.jpg" alt="Team Member 4">
        <h3>Sarah Johnson</h3>
        <p>Patient Care Specialist</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2023 HealthCare Solutions. All rights reserved.</p>
  </footer>
</body>
</html>
