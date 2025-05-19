<?php
// tips.php
$host = "localhost";
$user = "root";
$password = ""; // Update as needed
$dbname = "medical";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Define variables
$hospitalName = "Vishwaraj Hospital"; // Example name
$hospitalDescription = "Vishwaraj Hospital is known for its state-of-the-art facilities and compassionate care."; // Example description
?>


<?php
// You can add any necessary PHP logic at the top of this file

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Card with Image on Right</title>
    <style>
      :root {
        --primary-color: #084F08;
        --secondary-color: #53AC33;
        --text-color: #ffffff;
        --background-color: #f5f5f5;
      }

      body {
        font-family: Arial, sans-serif;
        background-color: var(--background-color);
      }

      /* Header Styles */
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
        height: 8%;
        width: 100px;
        margin-right: 10px;
      }

      .login-btn {
        font-size: 20px;
        background-color: var(--secondary-color);
        color: var(--text-color);
        padding: 5px 12px;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        font-size: 1rem;
      }
      .login-btn:hover {
        background-color: #4e8e34;
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

      /* Card Styles */
      .card-title{
        margin-top: 50px;
        font-size: 100px;
      }

      .card-container {
        width: 100%;
        height: 500px;
        display: flex;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 80%;
        margin: 20px auto;
        position: relative;
      }

      .card-left {
        padding: 20px;
        flex: 1;
        position: relative;
      }

      .menu-icon {
        position: absolute;
        top: 8px;
        left: 20px;
        font-size: 25px;
        cursor: pointer;
      }

      .menu-list {
        margin-bottom: 40px;
        display: none;
        background-color: #fff;
        position: absolute;
        top: 60px;
        left: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 200px;
        padding: 10px;
        border-radius: 5px;
      }

      .menu-list a {
        display: block;
        color: var(--primary-color);
        text-decoration: none;
        margin: 10px 0;
        font-size: 18px;
      }

      .menu-list a:hover {
        text-decoration: underline;
      }

      .card-right {
        margin: 10px;
        margin-top: 100px;
        margin-right: 30px;
        padding: 5px;
        width:600px ;
        height: 300px;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
      }

      .card-right img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .card-title {
        font-size: 28px;
        color: var(--primary-color);
        margin-bottom: 10px;
        margin-left: 10px;
      }

      .card-description {
        margin-left: 10px;
        font-size: 15px;
        color: #333;
        margin-bottom: 30px;
      }

      /* New styles for logo outside of card */
      .card-logo {
        margin-left: 830px;
        margin-top: 30px;
        position: absolute;
        top: 2px; /* Adjust the distance from the top */
        z-index: 10; /* Ensure logo is above the card */
      }
      .card-logo img {
       height: 10px; /* Reduced size */
       width: 80%;
}


h1{
  font-size: 20px;
  align-items: center;
  text-align: center;
}
.stats-section-wrapper {
  display: flex;
  align-items: center;
  position: relative;
  width: 100%;
  overflow: hidden;
  margin-top: 20px;
}

/* Stats Section (Scroll Container) */
.stats-section {
  display: flex;
  gap: 20px;
  overflow-x: auto;
  scroll-behavior: smooth;
  padding: 10px 0;
  width: 80%; /* Visible area for stats */
  margin: 0 auto;
  scrollbar-width: none;
  /* margin-top: 40px; Hide scrollbar for Firefox */
}

.stats-section::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari, Edge */
}

.stats-item {
  display: flex;
  flex-direction: column;  /* Stack elements vertically */
  align-items: center;     /* Center items horizontally */
  text-align: center;
  padding: 10px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.stats-item i {
  border: 2px solid #084F08;
  border-radius: 50%;
  font-size: 20px;  /* Increased icon size */
  color: #084F08;
  margin-bottom: 10px;
  padding: 8px;    /* More padding for better spacing */
  background-color: #e0f7e0;  /* Light background for icons */
}

.stats-item h3 {
  font-size: 15px;  /* Increased font size */
  color: #084F08;
  margin: 5px 0;
}

.stats-item p {
  font-size: 14px;
  color: #555;
  margin-top: 5px;
}

.arrow-btn {
  background-color: var(--primary-color);
  color: var(--text-color);
  border: none;
  border-radius: 50%;
  font-size: 15px;
  height: 30px;
  width: 30px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s;
  margin-top: 5px;
}

.arrow-btn:hover {
  background-color: var(--secondary-color);
}

.left-arrow {
  position: absolute;
  left: 2px;
}

.right-arrow {
  position: absolute;
  right: 20px;
}

/* Example: Icons as placeholders */
.icon-user::before {
  content: "👤";
}

.icon-patient::before {
  content: "💺";
}

.icon-surgery::before {
  content: "🛠";
}

.icon-employees::before {
  content: "👨‍💼";
}

.icon-bed::before {
  content: "🛏";
}

.icon-doctor::before {
  content: "👨‍⚕";
}

.icon-experience::before {
  content: "🏆";
}


    </style>
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="img/figma.logo.png" alt="Medical Team Logo">
      </div>
      <nav>
        <a href="home.php" data-page="home">Home</a>
        <a href="Appointment.php" data-page="Appointment">Book Appointment</a>
        <a href="upload.php" data-page="upload">Radiology</a>
        <a href="aboutUs.php" data-page="aboutUs">About Us</a>
        <a href="tips.php" data-page="health-tips">Health Tips</a>
        <button class="login-btn">Login</button>
      </nav>
    </header>

    <!-- Card with image on the right side -->
    <div class="card-container">
      <!-- Logo placed outside the image card -->
    

      <div class="card-left">
        <h2 class="card-title">VishwaRaj Hospital</h2>
        <p class="card-description">VishwaRaj Hospital is one of the best hospitals in Pune offering a wide range of services, making it a force to reckon with in the field of Super Speciality Tertiary Healthcare.
          VishwaRaj Hospital carries forward the MIT Group’s 40 years of legacy to provide ‘Excellent and High Quality Health Care’ 
          for the community. Commencing operations in the year 2016, the hospital has blossomed to become a trusted provider of innovative yet affordable healthcare,
           maintaining the philosophy that their doors are always open to one and all.</p>


           <h1>About Us</h1>
           <div class="stats-section-wrapper">
           
            <button class="arrow-btn left-arrow" onclick="scrollStats('left')">←</button>
            <div class="stats-section">
              <div class="stats-item">
                <i class="icon-user"></i>
                <h3>12,00,000+</h3>
                <p>No. of Lives Touched</p>
              </div>
              <div class="stats-item">
                <i class="icon-patient"></i>
                <h3>3,33,000+</h3>
                <p>No. of Admitted Patients</p>
              </div>
              <div class="stats-item">
                <i class="icon-surgery"></i>
                <h3>25,000+</h3>
                <p>Surgeries Done</p>
              </div>
              <div class="stats-item">
                <i class="icon-employees"></i>
                <h3>400</h3>
                <p>No. of Employees</p>
              </div>
              <div class="stats-item">
                <i class="icon-bed"></i>
                <h3>300</h3>
                <p>Bedded Hospital</p>
              </div>
              <div class="stats-item">
                <i class="icon-doctor"></i>
                <h3>200+</h3>
                <p>No. of Specialist Doctors</p>
              </div>
              <div class="stats-item">
                <i class="icon-experience"></i>
                <h3>7</h3>
                <p>Years of Experience</p>
              </div>
            </div>
            <button class="arrow-btn right-arrow" onclick="scrollStats('right')">→</button>
          </div>
          
          <!-- End of Stats Section -->


        <!-- Menu Icon -->
        <div class="menu-icon" onclick="toggleMenu()">☰</div>

        <!-- Menu List -->
        <div class="menu-list">
          <a href="#">Home</a>
          <a href="Appointment.php">Book Appointment</a>
          <a href="Check-Bed-Availability.php">Check Bed Availability</a>
          <a href="#">Specialties</a>
          <a href="#">Health Tips</a>
          <a href="#">Health Package</a>
          <a href="#">Photos</a>

        </div>
      </div>


    

      <div class="card-right">
        <img src="https://images1-fabric.practo.com/practices/1108786/vishwaraj-hospital-pune-5ef1e568a9205.jpg" alt="Healthcare Services">
      </div>
    </div>

    <script>
      function toggleMenu() {
        const menu = document.querySelector('.menu-list');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
      }

      function scrollStats(direction) {
  const statsContainer = document.querySelector('.stats-section');
  const scrollAmount = 200; // Adjust scroll distance as needed

  if (direction === 'right') {
    statsContainer.scrollLeft += scrollAmount;
  } else if (direction === 'left') {
    statsContainer.scrollLeft -= scrollAmount;
  }
}

    </script>
  </body>
</html>
