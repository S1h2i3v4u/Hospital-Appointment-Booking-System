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
$hospitalName = "VishwaRaj Hospital";
$hospitalDescription = "VishwaRaj Hospital is one of the best hospitals in Pune offering a wide range of services, making it a force to reckon with in the field of Super Speciality Tertiary Healthcare. VishwaRaj Hospital carries forward the MIT Group’s 40 years of legacy to provide ‘Excellent and High Quality Health Care’ for the community. Commencing operations in the year 2016, the hospital has blossomed to become a trusted provider of innovative yet affordable healthcare, maintaining the philosophy that their doors are always open to one and all.";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medical Team Website</title>
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

.search-container {
  display: flex;
  justify-content: center;
  padding: 20px;
}

.search-bar {
  width: 600px;
  padding: 10px;
  /* margin-right: 10px; */
  margin-left: 280px;
}

.search-btn {
  padding: 10px 20px;
  background-color: #53AC33;
}

.hospital-list {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  padding: 20px;
}

.hospital {
  text-align: center;
  border: 1px solid #ccc;
  padding: 10px;
}

.hospital img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  margin-bottom: 10px;
}

.hospital p {
  font-size: 16px;
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
        <a href="home.html" data-page="home">Home</a>
        <a href="Appointment.php" data-page="Book-Appointment">Book Appointment</a>
        <a href="upload.php" data-page="specialties">Radiology</a>
        <a href="aboutUs" data-page="about-us">About Us</a>
        <a href="tips.php" data-page="health-tips">Health Tips</a>
        <button id="loginButton" class="login-btn">Login</button>
      </nav>
    </header>

    <!-- Find Hospital Page -->
    <section id="find-hospital" class="page">
      <header>
        <div class="search-container">
          <input type="text" placeholder="Enter City or Hospital Name" class="search-bar" id="search-input">
          <button class="search-btn" id="search-btn">Search</button>
        </div>
      </header>
      <div class="hospital-list" id="hospital-list">
        <!-- Hospital cards will be rendered here -->
      </div>
    </section>

    <script>
      // Hospital Data for different cities and areas
      const hospitals = [
        // Hospitals for Pune
        { name: "VishwaRaj Hospital", city: "Pune", area: "Pune Loni Kalbhor", image: "https://images1-fabric.practo.com/practices/1108786/vishwaraj-hospital-pune-5ef1e568a9205.jpg",  aboutPage: "aboutHospital.php?vishwaraj" },
        { name: "Aditya Birla Memorial Hospital", city: "Pune", area: "Thergaon", image: "https://static.theceomagazine.net/wp-content/uploads/2021/09/21225813/NightHospital_EDIT-scaled.jpg" },
        { name: "Apple Hospital", city: "Pune", area: "Wakad", image: "https://medictrl.com/wp-content/uploads/2023/03/Apple-Hospital.webp" },
        { name: "Apollo Spectra Hospitals", city: "Pune", area: "Sadashiv Peth", image: "https://images.jdmagicbox.com/comp/pune/m4/020pxx20.xx20.150516123612.w8m4/catalogue/apollo-spectra-hospitals-sadashiv-peth-pune-multispeciality-hospitals-et2hq2xp40.jpg" },
        { name: "Poona Hospital", city: "Pune", area: "Deccan Gymkhana", image: "https://content.jdmagicbox.com/comp/pune/28/020p5081128/catalogue/poona-hospital-and-research-centre-sadashiv-peth-pune-dermatologists-27kj1.jpg" },
        { name: "KEM Hospital", city: "Pune", area: "Somwar Peth", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHuy0qrktrgAyuMYhbpN7G02Pnc8byux_ICw&s" },
        { name: "Bharati Hospital", city: "Pune", area: "Katraj", image: "https://bharatihospital.com/wp-content/uploads/2023/12/Blog-3-Image.jpeg" },
        { name: "Global Hospital", city: "Pune", area: "Dattawadi", image: "https://content3.jdmagicbox.com/comp/pune/w4/020pxx20.xx20.170628082026.z8w4/catalogue/dr-vinayak-dhongade-global-hospital-and-research-institute-dattawadi-pune-orthopaedic-doctors-wsd4f09lg3.jpg" },
        { name: "Noble Hospital", city: "Pune", area: "Hadapsar", image: "https://noblehrc.com/assets/imgs/aneximg.jpg" },
        { name: "Ruby Hall Clinic", city: "Pune", area: "Sassoon Road", image: "https://i.ytimg.com/vi/Ww3QQzCWfog/maxresdefault.jpg" },
        { name: "Sancheti Hospital", city: "Pune", area: "Shivaji Nagar", image: "https://images1-fabric.practo.com/practices/671829/sancheti-hospital-pune-5b868dd5ab1fc.jpg" },
        { name: "Jehangir Hospital", city: "Pune", area: "Sassoon Road", image: "https://images1-fabric.practo.com/jehangir-hospital-pune-1440398220-55dabb8c719a8.jpg/large" },
  
        // Hospitals for Phaltan
        { name: "J T POL Nikop Hospital", city: "Phaltan", area: "Ring Road", image: "https://content3.jdmagicbox.com/comp/satara/f6/9999p2168.2168.100831223807.j1f6/catalogue/dr-j-t-pol-nikop-hospital-phaltan-phaltan-hospitals-8d13r2e2ys.jpg" },
        { name: "Vora Baby Care Hospital", city: "Phaltan", area: "Shinganpur Road", image: "https://content.jdmagicbox.com/comp/satara/x6/9999p2162.2162.190306165050.e1x6/catalogue/dr-mohit-vora-vora-baby-care-hospital-phaltan-phaltan-paediatricians-ptqwku1mgh.jpg" },
        { name: "Suvidha Multispeciality Hospital", city: "Phaltan", area: "lakshminagar", image: "https://content3.jdmagicbox.com/comp/satara/c2/9999p2162.2162.220317142510.c4c2/catalogue/-6yj7ltt65f.jpg" },
        { name: "Kokare Hospital", city: "Phaltan", area: "kolki", image: "https://content.jdmagicbox.com/comp/satara/b9/9999p2162.2162.220311215901.l6b9/catalogue/kokare-accident-hospital-phaltan-satara-hospitals-isw1v2jqxa-250.jpg" },
       
        // Hospitals for Latur
        { name: "Mortale Patil Hospital", city: "Latur", area: "Barshi Road", image: "https://content.jdmagicbox.com/comp/latur/y6/9999p2382.2382.140622185853.q2y6/catalogue/mortale-hospital-latur-ho-latur-hospitals-6w09gmaq0f.jpg" },
        { name: "Galaxy Hospital & Critical Care Centre", city: "Latur", area: "dinanath nagar", image: "https://content.jdmagicbox.com/comp/latur/v8/9999p2382.2382.170924161228.k9v8/catalogue/galaxy-hospital-and-critical-care-center-latur-hospitals-c2kjc1bni0.jpg" },
        { name: "Ghule Orthopaedic Trauma & Sports Injury Hospital", city: "Latur", area: "ashok hotel", image: "https://content.jdmagicbox.com/comp/latur/d4/9999p2382.2382.190601165605.n9d4/catalogue/ghule-orthopaedic-trauma-and-sports-injury-hospital-latur-hospitals-gzp9dqc2tz.jpg" },
        { name: "Amar Hospital", city: "Latur", area: "kava road", image: "https://content.jdmagicbox.com/comp/latur/f9/9999p2382.2382.130815112531.p6f9/catalogue/amar-hospital-market-yard-latur-hospitals-txz03ulovq.jpg" },
       
        { name: "Lilavati Hospital", city: "Mumbai", area: "Bandra West", image: "https://lilavatihospital.com/uploads/home_banner/DefaultInnerImage.jpg" },
        { name: "Nanavati Super Speciality Hospital", city: "Mumbai", area: "Vile Parle West", image: "https://safartibbi.com/wp-content/uploads/2022/11/nanavati.jpg" },
        { name: "Kokilaben Dhirubhai Ambani Hospital", city: "Mumbai", area: "Andheri West", image: "https://d1ea147o02h74h.cloudfront.net/hospitals/hospital.jpg" },
        { name: "Bombay Hospital & Medical Research Centre", city: "Mumbai", area: "Marine Lines", image: "https://media.assettype.com/freepressjournal/2024-04/65fb00b8-9bc6-4897-b841-9de08279db05/hos.jpg" },

        { name: "Wockhardt Hospital", city: "Nashik", area: "Sharanpur Road", image: "https://hmsdesk.com/list/images/users/1629195671.jpg" },
        { name: "Suyash Hospital", city: "Nashik", area: "Panchavati", image: "https://cdn.hexahealth.com/Image/1727940514610-157001345.png" },
        { name: "Apollo Hospitals", city: "Nashik", area: "Trimbak Road", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTk3m9TaWXLoEWrV9SgKY_ynndnEf-8YtiBZw&s" },
        { name: "Shraddha Hospital", city: "Nashik", area: "Canada Corner", image: "https://content.jdmagicbox.com/comp/nashik/j5/0253px253.x253.131123140104.q3j5/catalogue/sai-shraddha-hospital-nashik-0iupd95zmj.jpg" },
 
        { name: "Kolhapur Institute of Orthopaedics & Trauma", city: "Kolhapur", area: "Shahupuri", image: "https://content3.jdmagicbox.com/comp/kolhapur/m4/0231px231.x231.140322211733.z5m4/catalogue/dr-bharati-kiran-doshi-kolhapur-orthopaedic-doctors-lnlpk3btbc.jpg" },
        { name: "Sterling Hospital", city: "Kolhapur", area: "Rajarampuri", image: "https://www.sterlinghospitals.com/_next/static/media/gurukul.219a8571.webp" },
        { name: "Ashwini Hospital", city: "Kolhapur", area: "Karvir", image: "https://content.jdmagicbox.com/comp/kolhapur/h6/0231px231.x231.110405080639.c6h6/catalogue/ashwini-hospital-kolhapur-railway-station-kolhapur-hospitals-y0kxmqs9jl.jpg" },
        { name: "Patil Hospital", city: "Kolhapur", area: "Shiroli", image: "https://static.wixstatic.com/media/afc863_15dda181bf8c434f8ade275f20004808~mv2_d_5344_3006_s_4_2.jpg/v1/fill/w_560,h_400,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/afc863_15dda181bf8c434f8ade275f20004808~mv2_d_5344_3006_s_4_2.jpg" },

      ];

      // Function to render hospital list
      function renderHospitals(hospitals) {
        const hospitalList = document.getElementById('hospital-list');
        hospitalList.innerHTML = ""; // Clear previous results

        hospitals.forEach(hospital => {
          const hospitalDiv = document.createElement('div');
          hospitalDiv.classList.add('hospital');
          hospitalDiv.innerHTML = `
            <a href="aboutHospital.php?hospital=${encodeURIComponent(hospital.name)}">
              <img src="${hospital.image}" alt="${hospital.name}">
            </a>
            <p>${hospital.name}</p>
            <p>${hospital.area}</p>
          `;
          hospitalList.appendChild(hospitalDiv);
        });
      }

      // Search functionality
      function searchHospitals() {
        const query = document.getElementById('search-input').value.toLowerCase();

        // Filter hospitals based on city, name, or area (case-insensitive)
        const filteredHospitals = hospitals.filter(hospital => 
          hospital.name.toLowerCase().includes(query) ||
          hospital.city.toLowerCase().includes(query) ||
          hospital.area.toLowerCase().includes(query)
        );

        if (filteredHospitals.length === 0) {
          alert("No hospitals found for the search query.");
        } else {
          renderHospitals(filteredHospitals);
        }
      }

      // Attach event listener to the search button
      document.getElementById('search-btn').addEventListener('click', searchHospitals);

      // Attach event listener to the Enter key in the search bar
      document.getElementById('search-input').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
          searchHospitals();
        }
      });

      // Initial render with all hospitals
      renderHospitals(hospitals);
    </script>

</body>
</html>
