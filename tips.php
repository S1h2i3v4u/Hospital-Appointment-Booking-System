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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health Tips</title>
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
      /* background-color: var(--primary-color); */
      color: var(--text-color);
    }

    .logo img {
      height: 40px;
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

    .health-tips-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      padding: 20px;
    }

    .sickness-box {
      background: white;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: transform 0.3s;
    }

    .sickness-box:hover {
      transform: scale(1.05);
    }

    .sickness-box img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 10px;
    }

    .sickness-box h3 {
      color: var(--primary-color);
      text-align: center;
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 10px;
      max-width: 500px;
      width: 90%;
      position: relative;
      text-align: center;
    }

    .modal-content img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    .modal-content h3 {
      color: var(--primary-color);
      margin: 10px 0;
    }

    .modal-content p {
      color: #333;
      font-size: 14px;
    }

    .modal-content .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      cursor: pointer;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-content .close-btn:hover {
      background: var(--secondary-color);
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/figma.logo.png" alt="Logo">
    </div>
    <nav>
      <a href="home.php">Home</a>
      <a href="Appointment.php">Book Appointment</a>
      <a href="#">Specialties</a>
      <a href="aboutus.php">About Us</a>
      <a href="health-tips.php">Health Tips</a>
      <button id="loginBtn" class="login-btn">Login</button>
    </nav>
  </header>

  <section class="health-tips-container">
    <script>
      const healthTips = [
        { name: "Common Cold", tip: "Drink plenty of fluids, rest, and use OTC cold remedies.", yoga: "Pranayama, Anulom Vilom", img: "imges/cold.jpg" },
        { name: "Headache", tip: "Stay hydrated, avoid stress, and rest in a quiet room.", yoga: "Balasana, Shavasana", img: "imges/Headaches.jpg" },
        { name: "Back Pain", tip: "Maintain good posture and stretch regularly.", yoga: "Bhujangasana, Tadasana", img: "imges/back.jpg" },
        { name: "Insomnia", tip: "Avoid caffeine before bed, maintain a sleep schedule.", yoga: "Shavasana, Uttanasana", img: "imges/insomnia.jpg" },
        { name: "Acne", tip: "Wash your face twice daily, avoid touching your face.", yoga: "Sarvangasana, Matsyasana", img: "imges/acne.jpg" },
        { name: "Diabetes", tip: "Eat a balanced diet, monitor blood sugar levels.", yoga: "Dhanurasana, Mandukasana", img: "imges/diabetes.jpg" },
        { name: "Stress", tip: "Practice deep breathing and mindfulness.", yoga: "Sukhasana, Padmasana", img: "imges/stress.jpg" },
        { name: "Obesity", tip: "Exercise regularly and control portion sizes.", yoga: "Surya Namaskar, Ustrasana", img: "imges/obesity-symptoms.jpg" },
        { name: "High BP", tip: "Reduce salt intake, exercise, and avoid stress.", yoga: "Savasana, Ardha Matsyendrasana", img: "imges/bp.jpg" },
        { name: "Asthma", tip: "Avoid triggers and take prescribed medication.", yoga: "Pranayama, Gomukhasana", img: "imges/asthma.jpg" },
        { name: "Depression", tip: "Talk to someone, exercise, and engage in hobbies.", yoga: "Viparita Karani, Uttanasana", img: "imges/depression.jpg" },
        { name: "Indigestion", tip: "Eat slowly and avoid spicy foods.", yoga: "Pavanamuktasana, Vajrasana", img: "imges/indigestion.jpg" },
        { name: "Eye Strain", tip: "Follow the 20-20-20 rule: every 20 mins, look 20 ft away for 20 secs.", yoga: "Palming, Trataka", img: "imges/strain.jpg" },
        { name: "Allergies", tip: "Avoid allergens, use antihistamines.", yoga: "Kapalabhati, Matsyasana", img: "imges/allergy.jpg" },
        { name: "Anxiety", tip: "Practice meditation and deep breathing.", yoga: "Sukhasana, Viparita Karani", img: "imges/anxiety.jpg" },
        { name: "Weak Immunity", tip: "Eat fruits, sleep well, and stay active.",yoga: "Pranayama, Surya Namaskar", img: "imges/weak_immune.jpg" },
        { name: "Hair Fall", tip: "Oil your hair, eat protein-rich foods.",yoga: "Adho Mukha Svanasana, Sarvangasana", img: "imges/hair-loss.jpg" },
        { name: "Joint Pain", tip: "Stay active and take Omega-3 supplements.",yoga: "Vrikshasana, Bhujangasana", img: "imges/joint-pain.jpg" },
        { name: "Fatigue", tip: "Get enough sleep, eat iron-rich foods.",yoga: "Balasana, Sukhasana", img: "imges/fatigue.jpg" },
        { name: "Skin Dryness", tip: "Use moisturizer and stay hydrated.",yoga: "Shavasana, Bhujangasana", img: "imges/dryskin.jpg" }
      ];

      // Render sickness boxes
      healthTips.forEach(tip => {
        document.write(`
          <div class="sickness-box" onclick="openModal('${tip.name}', '${tip.tip}', '${tip.yoga}', 'img/${tip.img}')">
            <img src="img/${tip.img}" alt="${tip.name}">
            <h3>${tip.name}</h3>
          </div>
        `);
      });

      // Modal functionality
      function openModal(name, tip, yoga, img) {
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.innerHTML = `
          <div class="modal-content">
            <button class="close-btn" onclick="closeModal()">×</button>
            <img src="${img}" alt="${name}">
            <h3>${name}</h3>
            <p><strong>Tips:</strong> ${tip}</p>
            <p><strong>Yoga:</strong> ${yoga}</p>
          </div>
        `;
        document.body.appendChild(modal);
        modal.style.display = 'flex';
      }

      function closeModal() {
        const modal = document.querySelector('.modal');
        if (modal) {
          modal.remove();
        }
      }
    </script>
  </section>
</body>
</html>