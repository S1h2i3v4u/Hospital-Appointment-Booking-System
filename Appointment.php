<?php
$host = "localhost";
$user = "root";
$password = ""; // Update if your MySQL password is not blank
$dbname = "medical";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $doctor_name = $_POST["doctor_name"];
  $time_slot = $_POST["time_slot"];
  $patient_name = $_POST["patient_name"];
  $contact_number = $_POST["contact_number"];

  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO appointments (doctor_name, time_slot, patient_name, contact_number) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $doctor_name, $time_slot, $patient_name, $contact_number);

  if ($stmt->execute()) {
    echo "<script>alert('Appointment booked successfully!');</script>";
  } else {
    echo "<script>alert('Error booking appointment. Please try again.');</script>";
  }
  $stmt->close();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Hospital Management</title>
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

      .logo {
        display: flex;
        align-items: center;
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

      header nav a:hover {
        text-decoration: underline;
      }

      header .login-btn {
        background-color: var(--primary-color);
        color: var(--text-color);
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      header .login-btn:hover {
        background-color: var(--secondary-color);
      }

      .page {
        display: none;
        padding: 20px;
      }

      .page.active {
        display: block;
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

      .title {
        background-color: #4CAF50;
        color: white;
        font-size: 1.5rem;
        padding: 10px;
        border-radius: 5px;
      }

      .doctors {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-top: 20px;
      }

      .doctor-card {
        width: 20%;
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

      .doctor-card .doctor-info {
        font-size: 0.9rem;
        margin: 10px 0;
      }

      .doctor-card .doctor-info h3 {
        font-size: 1rem;
        margin: 5px 0;
        font-weight: bold;
      }

      .doctor-card .doctor-info p {
        margin: 3px 0;
        color: #666;
      }

      .book-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        font-size: 1rem;
        border-radius: 5px;
        margin-top: 10px;
      }

      .book-btn:hover {
        background-color: #45a049;
      }

      @media (max-width: 1200px) {
        .doctor-card {
          width: 48%;
        }
      }

      @media (max-width: 768px) {
        .doctor-card {
          width: 100%;
        }
      }


      /* login button */

      
    </style>
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="img/figma.logo.png" alt="Medical Team Logo">
      </div>
      <nav>
        <a href="home.php" data-page="home">Home</a>
        <a href="Appointment.php" data-page="Book-Appointment">Book Appointment</a>
        <a href="upload.php" data-page="specialties">Rediology</a>
        <a href="aboutus.php" href="#about-us" data-page="about-us">About Us</a>
        <a href="health-tips.php" data-page="health-tips">Health Tips</a>
        <button class="login-btn">Login</button>
      </nav>
    </img>

    </header>


    <section id="Book-Appointment" class="page active">
  <div class="container">
    <div class="title">BOOK AN APPOINTMENT</div>
    <div class="doctors">
      <?php
      $doctors = [
        ["img" => "img/dr0.jpg", "name" => "Dr. Sachin Katkade", "desc1" => "HOD Emergency Department", "desc2" => "Assistant Medical Superintendent"],
        ["img" => "img/dr1.jpg", "name" => "Dr. Vitthal Shendge", "desc1" => "HOD - Anaesthesia", "desc2" => "MBBS, DA, DNB, EDAIC"],
        ["img" => "img/dr2.jpg", "name" => "Dr. Kshitij Gaikwad", "desc1" => "Anaesthesia", "desc2" => "MBBS, DA"],
        ["img" => "img/dr3.jpg", "name" => "Dr. Smita Patil", "desc1" => "Anaesthesia", "desc2" => "MBBS, MD"],
        ["img" => "img/dr8.jpg", "name" => "Dr. Sachin Katkade", "desc1" => "HOD Emergency Department", "desc2" => "Assistant Medical Superintendent"],
        ["img" => "img/dr5.jpg", "name" => "Dr. Vitthal Shendge", "desc1" => "HOD - Anaesthesia", "desc2" => "MBBS, DA, DNB, EDAIC"],
        ["img" => "img/dr6.jpg", "name" => "Dr. Kshitij Gaikwad", "desc1" => "Anaesthesia", "desc2" => "MBBS, DA"],
        ["img" => "img/dr7.jpg", "name" => "Dr. Smita Patil", "desc1" => "Anaesthesia", "desc2" => "MBBS, MD"]
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
          <a href="#" class="book-btn" onclick="openBookingModal(\'' . addslashes($doc["name"]) . '\')">Book</a>
        </div>';
      }
      ?>
    </div>
  </div>
</section>


    <script>
     document.addEventListener("DOMContentLoaded", function () {
  const bookButtons = document.querySelectorAll(".book-btn");

  function showTimeSlotModal(doctorName) {
    const existingModal = document.getElementById("time-slot-modal");
    if (existingModal) existingModal.remove();

    const modal = document.createElement("div");
    modal.id = "time-slot-modal";
    modal.style = `
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5); display: flex; align-items: center;
      justify-content: center; z-index: 1000;
    `;

    modal.innerHTML = `
      <div style="background: white; padding: 20px; border-radius: 10px; width: 300px; text-align: center;">
        <h3>Select Time Slot</h3>
        <p>Doctor: ${doctorName}</p>
        <select id="time-slot" style="width: 100%; padding: 5px; margin: 10px 0;">
          <option value="9:00 AM">9:00 AM</option>
          <option value="10:00 AM">10:00 AM</option>
          <option value="11:00 AM">11:00 AM</option>
          <option value="2:00 PM">2:00 PM</option>
          <option value="3:00 PM">3:00 PM</option>
        </select>
        <button id="continue-btn" style="padding: 5px 10px; background: var(--primary-color, #007BFF); color: white; border: none; border-radius: 5px;">Continue</button>
        <button id="close-btn" style="margin-top: 10px; padding: 5px 10px; background: #ccc; border: none; border-radius: 5px;">Cancel</button>
      </div>
    `;
    document.body.appendChild(modal);

    modal.querySelector("#continue-btn").addEventListener("click", function () {
      const selectedTime = modal.querySelector("#time-slot").value;
      modal.remove();
      showPatientInfoForm(doctorName, selectedTime);
    });

    modal.querySelector("#close-btn").addEventListener("click", function () {
      modal.remove();
    });
  }

  function showPatientInfoForm(doctorName, timeSlot) {
    const existingModal = document.getElementById("patient-info-modal");
    if (existingModal) existingModal.remove();

    const modal = document.createElement("div");
    modal.id = "patient-info-modal";
    modal.style = `
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5); display: flex; align-items: center;
      justify-content: center; z-index: 1000;
    `;

    modal.innerHTML = `
      <div style="background: white; padding: 20px; border-radius: 10px; width: 300px; text-align: center;">
        <h3>Patient Information</h3>
        <p>Doctor: ${doctorName}</p>
        <p>Time Slot: ${timeSlot}</p>
        <form id="patient-form">
          <input type="text" id="patient-name" placeholder="Enter Name" required style="width: 100%; padding: 5px; margin: 10px 0;" />
          <input type="text" id="patient-contact" placeholder="Enter Contact Number" required style="width: 100%; padding: 5px; margin: 10px 0;" />
          <button type="submit" style="padding: 5px 10px; background: var(--primary-color, #007BFF); color: white; border: none; border-radius: 5px;">Submit</button>
        </form>
        <button id="cancel-btn" style="margin-top: 10px; padding: 5px 10px; background: #ccc; border: none; border-radius: 5px;">Cancel</button>
      </div>
    `;
    document.body.appendChild(modal);

    modal.querySelector("#patient-form").addEventListener("submit", function (event) {
      event.preventDefault();

      const name = modal.querySelector("#patient-name").value.trim();
      const contact = modal.querySelector("#patient-contact").value.trim();

      if (!name || !contact) {
        alert("Please fill all fields.");
        return;
      }

      fetch("appointment.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `doctor_name=${encodeURIComponent(doctorName)}&time_slot=${encodeURIComponent(timeSlot)}&patient_name=${encodeURIComponent(name)}&contact_number=${encodeURIComponent(contact)}`
      })
      .then(response => response.text())
      .then(data => {
        modal.remove();
        displayQueuePosition(doctorName, timeSlot);
      })
      .catch(error => {
        console.error("Error:", error);
        alert("Failed to book appointment. Try again.");
      });
    });

    modal.querySelector("#cancel-btn").addEventListener("click", function () {
      modal.remove();
    });
  }

  function displayQueuePosition(doctorName, timeSlot) {
    const queuePosition = Math.floor(Math.random() * 10) + 1;
    const estimatedTime = queuePosition * 10;

    const modal = document.createElement("div");
    modal.id = "queue-modal";
    modal.style = `
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5); display: flex; align-items: center;
      justify-content: center; z-index: 1000;
    `;

    modal.innerHTML = `
      <div style="background: white; padding: 20px; border-radius: 10px; width: 300px; text-align: center;">
        <h3>Appointment Details</h3>
        <p>Doctor: ${doctorName}</p>
        <p>Time Slot: ${timeSlot}</p>
        <p>Queue Position: ${queuePosition}</p>
        <p>Estimated Wait Time: ${estimatedTime} minutes</p>
        <button id="close-queue-btn" style="margin-top: 10px; padding: 5px 10px; background: var(--primary-color, #007BFF); color: white; border: none; border-radius: 5px;">Close</button>
      </div>
    `;
    document.body.appendChild(modal);

    modal.querySelector("#close-queue-btn").addEventListener("click", function () {
      modal.remove();
    });
  }

  bookButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      const doctorCard = event.target.closest(".doctor-card");
      const doctorName = doctorCard?.querySelector(".doctor-info h3")?.textContent || "Unknown Doctor";
      showTimeSlotModal(doctorName);
    });
  });
});

    </script>
   
  </body>
</html>