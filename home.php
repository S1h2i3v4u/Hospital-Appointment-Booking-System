<?php
// Start session (optional, if you plan login system)
session_start();

// Database connection (update credentials below)
$host = "localhost";   // or 127.0.0.1
$username = "root";    // your MySQL username
$password = "";        // your MySQL password
$database = "medical"; // your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

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
  <title>Medical Team Website</title>
  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    :root {
      --primary-color: #084F08;
      --secondary-color: #53AC33;
      --text-color: #ffffff;
      --background-color: #f5f5f5;
    }
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: var(--background-color);
      overflow-x: hidden;
    }
    header {
      height: 50px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      color: var(--text-color);
    }
    .logo {
      display: flex;
      align-items: center;
    }
    .logo img {
      padding-top: 10px;
      height: 8%;
      width: 100px;
      margin-right: 10px;
    }
    header nav {
      display: flex;
      align-items: center;
    }
    header nav a {
      color: var(--primary-color);
      text-decoration: none;
      margin: 0 15px;
      font-size: 18px;
      cursor: pointer;
    }
    header nav a:hover {
      text-decoration: underline;
    }
    .login-link {
      display: flex;
      align-items: center;
      color: var(--primary-color);
      font-size: 18px;
      text-decoration: none;
      margin-left: 15px;
    }
    .login-link i {
      margin-right: 6px;
      font-size: 20px;
    }
    .login-link:hover {
      text-decoration: underline;
    }
    .chatbot-btn {
      color: var(--text-color);
      padding: 8px;
      text-align: center;
      cursor: pointer;
      font-size: 1.0rem;
      transition: background-color 0.3s;
      margin-left: 20px;
    }
    .chatbot-btn:hover {
      background-color: #4e8e34;
    }
    .chatbot-btn i {
      font-size: 1.0rem;
    }
    .page {
      display: none;
      padding: 20px;
    }
    .page.active {
      display: block;
    }
    .hero {
      width: 100%;
      height: 550px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      background-color: #ffffff; 
      color: var(--primary-color);
      border-radius: 10px;
      overflow: hidden; 
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .hero::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 30%;
      background-color: var(--secondary-color); 
      z-index: 0; 
    }
    .hero-content,
    .hero-image {
      position: relative;
      z-index: 1;
    }
    .hero-content {
      max-width: 50%;
      margin-bottom: 200px;
    }
    .hero-image {
      height: 400px;
      width: auto;
      max-width: 40%;
      margin-right: 80px;
      margin-bottom: 150px;
    }
    .hero-image img {
      width: 100%;
      height: 300px;
      border-radius: 10px;
    }
    .hero-content h1 {
      margin-left: 200px;
      font-size: 40px;
    }
    .hero-content p {
      font-size: 15px;
      margin-left: 100px;
    }
    .check-btn {
      display: inline-block;
      background-color: var(--secondary-color);
      color: var(--text-color);
      padding: 10px 20px;
      border-radius: 5px;
      text-align: center;
      cursor: pointer;
      font-size: 1rem;
      margin-left: 280px;
      margin-top: 20px;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .check-btn:hover {
      background-color: #4e8e34;
    }
    .features-section {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 5px 0;
      background-color: transparent;
      z-index: 1;
    }
    .feature-box {
      text-align: center;
      width: 18%;
      max-width: 200px;
      margin: 0 5px;
    }
    .feature-box img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 2px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <header>
    <div class="logo">
      <img src="img/figma.logo.png" alt="Medical Team Logo">
    </div>
    <nav>
      <a href="home.php" data-page="home">Home</a>
      <a href="upload.php" data-page="upload">Radiology</a>
      <a href="aboutUs.php" data-page="about-us">About Us</a>
      <a href="tips.php" data-page="health-tips">Health Tips</a>

      <!-- Login Icon with text -->
      <a href="login.php" class="login-link">
        <i class="fas fa-user"></i> Log in
      </a>

      <!-- Chatbot Icon -->
      <button class="chatbot-btn">
        <i class="fas fa-comment-dots"></i>
      </button>
    </nav>
  </header>

  <!-- Home Page -->
  <section id="home" class="page active">
    <main class="hero">
      <div class="hero-content">
        <h1>HELLO PATIENT</h1>
        <p>Seamless Care, Smarter Queues: Connecting Hospitals, Empowering Cities.</p>
        <a href="searchHospital.php" class="check-btn">Check Here</a>
      </div>
      <div class="hero-image">
        <img src="img/figma_img1.png" alt="Medical Team">
      </div>

      <!-- Features Section inside Hero -->
      <section class="features-section">
        <div class="feature-box">
          <img src="https://ประกันมันดี.com/wp-content/uploads/2021/05/flat-hand-drawn-patient-taking-medical-examination_52683-57829.jpg" alt="OPD Appointment">
          <p>Book OPD Appointment</p>
        </div>
        <div class="feature-box">
          <img src="https://static.vecteezy.com/system/resources/previews/010/891/519/non_2x/modern-cleaning-emergency-department-flat-color-illustration-empty-beds-in-medical-ward-patients-care-fully-editable-2d-simple-cartoon-interior-with-hospital-equipment-on-background-vector.jpg" alt="Bed Availability">
          <p>Check Bed Availability</p>
        </div>
        <div class="feature-box">
          <img src="https://assets-wp-cdn.onsurity.com/wp/wp-content/uploads/2024/06/19194951/difference-between-opd-and-ipd-treatment.jpg" alt="Patient Admission">
          <p>Patient Admission</p>
        </div>
        <div class="feature-box">
          <img src="https://cdni.iconscout.com/illustration/premium/thumb/city-hospital-with-medical-staff-illustration-download-in-svg-png-gif-file-formats--healthcare-center-team-building-pack-illustrations-3798626.png?f=webp" alt="City-Wide Integration">
          <p>City-Wide Integration</p>
        </div>
      </section>
    </main>
  </section>
</body>
</html>
