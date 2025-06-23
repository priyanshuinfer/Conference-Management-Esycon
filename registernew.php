<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #d8e3fc, #fce7f3);
      font-family: 'Raleway', sans-serif;
    }
    .form-container {
      max-width: 900px;
      margin: 3rem auto;
      background: #fff;
      border-radius: 10px;
      padding: 20px 30px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .form-header {
      text-align: center;
      margin-bottom: 30px;
    }
    .form-header h2 {
      font-size: 24px;
      font-weight: bold;
    }
    .form-steps {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
  position: relative;
  width: 100%; /* Ensure full width for the lines */
}

.form-steps .step {
  text-align: center;
  font-size: 14px;
  color: #6c757d;
  position: relative;
  flex: 1; /* Allow steps to stretch equally */
}

.form-steps .step.active {
  color: #007bff;
  font-weight: bold;
}

.form-steps .step .circle {
  width: 30px;
  height: 30px;
  line-height: 30px;
  border-radius: 50%;
  margin: 0 auto 5px auto;
  background: #e9ecef;
  color: #6c757d;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  z-index: 2;
  position: relative;
}

.form-steps .step.active .circle {
  background: #007bff;
  color: #fff;
}

.form-steps .line {
  position: absolute;
  top: 15px; /* Position the line below the circle */
  left: 10%;
  width: 80%;
  height: 3px;
  background: #e9ecef;
  z-index: 1;
  transition: background 0.3s ease;
}

.form-steps .step.active + .line {
  background: #007bff;
}

.form-steps .line.hidden {
  display: none;
}

.form-steps .step:first-child .line {
  display: none; /* Hide line before the first step */
}

.form-steps .step:last-child .line {
  display: none; /* Hide line after the last step */
}


    .form-section {
      display: none;
    }
    .form-section.active {
      display: block;
    }
    .form-buttons {
      text-align: right;
      margin-top: 20px;
    }
    .form-buttons .btn {
      padding: 10px 20px;
    }
    .logo {
      position: absolute;
      top: 10px;
      left: 20px;
      display: flex;
      align-items: center;
    }
    .logo img {
      width: 80px;
      height: auto;
      margin-right: 10px;
    }
    .logo-name {
      font-size: 24px;
      font-weight: bold;
      color: black;
    }
    .login-link {
      position: absolute;
      top: 10px;
      right: 20px;
      font-size: 16px;
      color: black;
    }
    .login-link a {
      text-decoration: none;
      color: #003366;
    }
  </style>
</head>
<body>
  <div class="logo">
    <img src="esyconlog.png" alt="Logo" />
    <span class="logo-name">EsyCon</span>
  </div>
  <div class="login-link">
    <span>Already a user? <a href="index.php">Login</a></span>
  </div>
  <div class="form-container">
    <div class="form-header">
      <h2>Create a New Esy-Con Account</h2>
      <p>Enter the details to get going</p>
    </div>
    <div class="form-steps">
  <div class="step active" onclick="goToStep(0)">
    <div class="circle">1</div>
    <div>Name</div>
  </div>
  <div class="line"></div>
  <div class="step" onclick="goToStep(1)">
    <div class="circle">2</div>
    <div>Affiliation</div>
  </div>
  <div class="line"></div>
  <div class="step" onclick="goToStep(2)">
    <div class="circle">3</div>
    <div>Mailing Address</div>
  </div>
  <div class="line"></div>
  <div class="step" onclick="goToStep(3)">
    <div class="circle">4</div>
    <div>Contact Information</div>
  </div>
  <div class="line"></div>
  <div class="step" onclick="goToStep(4)">
    <div class="circle">5</div>
    <div>Miscellaneous</div>
  </div>
</div>

    <form action="register_process.php" method="POST">
      <div class="form-section active" id="nameSection">
        <h4>NAME</h4>
        <div class="row g-3">
          <div class="col-md-6">
            <label for="title" class="form-label">Salutation</label>
            <select class="form-select" id="salutation" name="salutation" required>
              <option value="">-- Choose salutation --</option>
              <option value="mr">Mr.</option>
              <option value="mrs">Mrs.</option>
              <option value="ms">Ms.</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required />
          </div>
          <div class="col-md-6">
            <label for="middle_initial" class="form-label">Middle Initial</label>
            <input type="text" class="form-control" id="middle_initial" name="middle_initial" placeholder="Middle initial, if any" />
          </div>
          <div class="col-md-6">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required />
          </div>
          <div class="col-md-6">
            <label for="suffix" class="form-label">Suffix</label>
            <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Jr., Sr., or III" />
          </div>
        </div>
      </div>
      <div class="form-section" id="affiliationSection">
        <h4>AFFILIATION</h4>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" name="status" required>
            <option value="">-- Invalid --</option>
            <option value="student">Student</option>
            <option value="professional">Professional</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="current_affiliation" class="form-label">Current Affiliation</label>
          <input type="text" class="form-control" id="current_affiliation" name="current_affiliation" required />
        </div>
        <div class="mb-3">
          <label for="job_title" class="form-label">Job Title</label>
          <input type="text" class="form-control" id="job_title" name="job_title" required />
        </div>
      </div>
      <div class="form-section" id="mailingAddressSection">
        <h4>MAILING ADDRESS</h4>
        <div class="row g-3">
          <div class="col-md-6">
            <label for="room" class="form-label">Room</label>
            <input type="text" class="form-control" id="room" name="room" required />
          </div>
          <div class="col-md-6">
            <label for="building" class="form-label">Building</label>
            <input type="text" class="form-control" id="building" name="building" required />
          </div>
          <div class="col-md-6">
            <label for="street_address" class="form-label">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address" required />
          </div>
          <div class="col-md-6">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" required />
          </div>
          <div class="col-md-6">
            <label for="state" class="form-label">State/Province</label>
            <input type="text" class="form-control" id="state" name="state" required />
          </div>
          <div class="col-md-6">
            <label for="postal_code" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" required />
          </div>
          <div class="col-md-6">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" id="country" name="country" required />
          </div>
        </div>
      </div>
      <div class="form-section" id="contactInformationSection">
        <h4>CONTACT INFORMATION</h4>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required />
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" id="phone" name="phone" required />
        </div>
      </div>
      <div class="form-section" id="miscellaneousSection">
  <h4>MISCELLANEOUS</h4>
  <div class="mb-3">
    <label for="timezone" class="form-label">Timezone</label>
    <select class="form-select" id="timezone" name="timezone" required>
      <option value="">-- Select Timezone --</option>
      <option value="pst">PST (Pacific Standard Time)</option>
      <option value="mst">MST (Mountain Standard Time)</option>
      <option value="cst">CST (Central Standard Time)</option>
      <option value="est">EST (Eastern Standard Time)</option>
      <!-- Add other timezones as necessary -->
    </select>
  </div>
  <div class="mb-3">
    <label for="special_needs" class="form-label">Special Needs</label>
    <textarea class="form-control" id="special_needs" name="special_needs" rows="3"></textarea>
  </div>
  <div class="mb-3">
    <label for="shirt_size" class="form-label">Shirt Size</label>
    <select class="form-select" id="shirt_size" name="shirt_size" required>
      <option value="">-- Select Shirt Size --</option>
      <option value="s">Small</option>
      <option value="m">Medium</option>
      <option value="l">Large</option>
      <option value="xl">XL</option>
      <option value="xxl">XXL</option>
      <!-- Add more sizes if needed -->
    </select>
  </div>
  <div class="mb-3">
    <label for="gender" class="form-label">Gender</label>
    <select class="form-select" id="gender" name="gender" required>
      <option value="">-- Select Gender --</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select>
  </div>
  <div class="mb-3">
    <input type="checkbox" id="consent" name="consent" required />
    <label for="consent" class="form-label">I consent with EsyCon policies</label>
  </div>
  <!-- Submit button only in Miscellaneous section -->
  <div class="form-buttons">
    
    <button type="submit" class="btn btn-success" id="submitButton" style="display: none;">Submit</button>
  </div>
</div>
<div class="form-buttons">
    <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
    <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
    <button type="submit" class="btn btn-success" id="submitButton" style="display: none;">Submit</button>
  </div>
</div>
    </form>
  </div>
  <script>
    let currentStep = 0;
    const formSections = document.querySelectorAll('.form-section');
    const steps = document.querySelectorAll('.step');

    function showStep(index) {
  formSections.forEach((section, i) => {
    section.classList.toggle('active', i === index);
    steps[i].classList.toggle('active', i === index);
  });

  // Show submit button only for Miscellaneous section (Step 5)
  const submitButton = document.getElementById('submitButton');
  if (index === formSections.length - 1) {  // Miscellaneous section
    submitButton.style.display = 'inline-block';
  } else {
    submitButton.style.display = 'none';
  }
}


    function nextStep() {
      if (currentStep < formSections.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    }

    function prevStep() {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    }

    function goToStep(index) {
      currentStep = index;
      showStep(index);
    }

    showStep(currentStep);
  </script>
</body>
</html>
