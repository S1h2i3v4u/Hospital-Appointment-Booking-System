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

// Backend logic to handle POST requests for chatbot response
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = strtolower(trim($_POST['message'] ?? '')) ;

    // Responses based on keywords or questions
    $responses = [
        'ambulance' => "The ambulance number is 📞 123-456-7890. \nWould you like to know the nearest hospital's phone number?",
        'ambulance number' => "The ambulance number is 📞 123-456-7890. \nWould you like to know the nearest hospital's phone number?",
        'opd' => "Our OPD runs from 9 AM to 5 PM, Monday to Saturday.",
        'doctor' => "Please specify the category of doctor you're looking for (e.g., General, Pediatrician, Surgeon).",
        'hello' => "Hello! How can I help you today?",
        'hi' => "Hi there! Ask me anything about our hospital services.",
        'thanks' => "You're welcome!",
        'thank you' => "Glad to help!",
        'nearby hospital' => getNearbyHospitals(),
    ];

    // Check for doctor category request
    if (strpos($message, 'doctor') !== false) {
        $category = extractCategory($message);
        if ($category) {
            $responses['doctor'] = getDoctorsByCategory($category);
        } else {
            $responses['doctor'] = "Please specify a category of doctor. For example, 'General', 'Pediatrician', or 'Surgeon'.";
        }
    }

    // Check if the message contains any keyword and respond
    $reply = "I'm sorry, I don't understand that. Can you rephrase?";

    foreach ($responses as $keyword => $response) {
        if (strpos($message, $keyword) !== false) {
            $reply = $response;
            break;
        }
    }

    echo $reply;
    exit;
}

// Function to get nearby hospitals with distance
function getNearbyHospitals() {
    // This is mock data, you can replace this with actual data from a database or API
    $hospitals = [
        ['name' => 'City Hospital', 'distance' => '2 km', 'phone' => '987-654-3210'],
        ['name' => 'Greenfield Hospital', 'distance' => '5 km', 'phone' => '987-654-0000'],
        ['name' => 'Sunshine Clinic', 'distance' => '3 km', 'phone' => '987-654-5555'],
    ];

    $response = "Here are some nearby hospitals:\n";
    foreach ($hospitals as $hospital) {
        $response .= $hospital['name'] . " - Distance: " . $hospital['distance'] . " - Phone: " . $hospital['phone'] . "\n";
    }

    return $response;
}

// Function to extract doctor category from the user's message
function extractCategory($message) {
    // Example categories
    $categories = ['general', 'pediatrician', 'surgeon'];
    foreach ($categories as $category) {
        if (strpos($message, $category) !== false) {
            return $category;
        }
    }
    return null;
}

// Function to get doctors by category (mock data for now)
function getDoctorsByCategory($category) {
    $doctors = [
        'general' => [
            ['name' => 'Dr. Smith', 'hospital' => 'City Hospital'],
            ['name' => 'Dr. Johnson', 'hospital' => 'Greenfield Hospital'],
        ],
        'pediatrician' => [
            ['name' => 'Dr. Emily', 'hospital' => 'Sunshine Clinic'],
            ['name' => 'Dr. Mike', 'hospital' => 'Greenfield Hospital'],
        ],
        'surgeon' => [
            ['name' => 'Dr. Williams', 'hospital' => 'City Hospital'],
            ['name' => 'Dr. Clark', 'hospital' => 'Greenfield Hospital'],
        ],
    ];

    if (isset($doctors[$category])) {
        $response = "Here are some nearby doctors in the category of " . ucfirst($category) . ":\n";
        foreach ($doctors[$category] as $doctor) {
            $response .= $doctor['name'] . " - Hospital: " . $doctor['hospital'] . "\n";
        }
        return $response;
    } else {
        return "Sorry, I couldn't find any doctors in that category.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hospital Chatbot</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #F5F7FA, #DCE1E9);
      padding: 0;
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
    h2 {
      text-align: center;
      color: #3E4E69;
      margin-bottom: 20px;
    }
    #chat-container {
      background: #FFFFFF;
      padding: 20px;
      width: 800px;
      max-width: 100%;
      min-height: 350px;
      border-radius: 10px;
      border: 1px solid #ddd;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      position: relative;
    }
    #chat-box {
      background: #FFFFFF;
      padding: 10px;
      max-height: 300px;
      height: auto;
      overflow-y: auto;
      border-radius: 10px;
      border: 1px solid #ddd;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      font-size: 16px;
      color: #333;
    }
    .user, .bot {
      margin: 10px 0;
      padding: 10px;
      border-radius: 8px;
      width: fit-content;
      max-width: 70%;
      clear: both;
    }
    .user {
      background-color: #ADD8E6;
      color: #002f6c;
      margin-left: auto;
      text-align: right;
    }
    .bot {
      background-color: #C8E6C9;
      color: #2c6e3f;
      margin-right: auto;
    }
    .bot, .user {
      animation: fadeIn 0.5s ease-out;
    }
    .input-container {
      display: flex;
      justify-content: space-between;
      width: 100%;
    }
    input[type="text"] {
      width: 80%;
      padding: 10px;
      border: 2px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }
    button {
      width: 15%;
      padding: 10px 15px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-left: 10px;
    }
    button:hover {
      background-color: #45a049;
    }
    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }


    .logo {
      position: absolute;
      top: 10px;
      left: 10px;
      z-index: 10;
    }
    
    .logo img {
      width: 80px; /* Adjust the size of the logo */
      height: auto;
    }
  </style>
</head>
<body>
<div class="logo">
    <img src="img/figma.logo.png" alt="Medical Team Logo">
  </div>


<h2>Hospital Chatbot</h2>

<div id="chat-container">
  <div id="chat-box"></div>
  <div class="input-container">
    <input type="text" id="user-input" placeholder="Ask a question..." />
    <button onclick="sendMessage()">Send</button>
  </div>
</div>

<script>

function sendMessage() {
  const input = document.getElementById("user-input");
  const message = input.value.trim();
  if (!message) return;

  const chatBox = document.getElementById("chat-box");
  chatBox.innerHTML += `<div class="user">You: ${message}</div>`;

  // Send the message to the same PHP file (chatbot.php)
  fetch('chatbot.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `message=${encodeURIComponent(message)}`
  })
  .then(res => res.text())
  .then(data => {
    chatBox.innerHTML += `<div class="bot">Bot: ${data}</div>`;
    chatBox.scrollTop = chatBox.scrollHeight;
    input.value = '';
  });
}

// Add event listener for Enter key
document.getElementById('user-input').addEventListener('keypress', function(event) {
  if (event.key === 'Enter') {
    sendMessage();
  }
});
</script>



</body>
</html>
