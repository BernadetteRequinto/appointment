
<?php

    include_once'templates/header.php';

?>
    <div class="container">
        <div class="tabs">
          <div class="tab" id="registrationTab" onclick="showForm('registrationForm')">Patient Registration</div>
          <div class="tab" id="appointmentTab" onclick="showForm('appointmentForm')">Appointment Form</div>
          <div class="tab" id="DoctorTab" onclick="showForm('doctorForm')">Doctor Details </div>
        </div>
    
        <form id="registrationForm" class="form">
          <h2>Patient Registration</h2>
          <label for="fullName">Full Name:</label>
          <input type="text" id="fullName" name="fullName" required>
    
          <label for="dob">Date of Birth:</label>
          <input type="date" id="dob" name="dob" onchange="calculateAge()" required>
    
          <label for="age">Age:</label>
          <input type="text" id="age" name="age" readonly>
    
          <label for="gender">Gender:</label>
          <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
    
          <label for="bloodType">Blood Type:</label>
          <select id="bloodType" name="bloodType" onchange="handleBloodTypeChange(this.value)" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
           <option value="Other">Other</option>
          </select>
          <div id="otherBloodType" style="display: none;">
          <label for="otherBloodTypeInput">Other Blood Type:</label>
          <input type="text" id="otherBloodTypeInput" name="otherBloodTypeInput">
         </div>
         <button type="button" onclick="nextForm()">Next</button>
        </form>


        </form>
    
        <form id="appointmentForm" class="form" style="display: none;">
          <h2>Appointment Form</h2>
          <label for="appointmentDate">Appointment Date:</label>
          <input type="date" id="appointmentDate" name="appointmentDate" required>
    
          <label for="appointmentTime">Appointment Time:</label>
          <input type="time" id="appointmentTime" name="appointmentTime" required>
    
          <button type="button" onclick="submitAppointment()">Submit</button>
           </form>
      

      <form id="doctorForm" class="form" style="display: none;">
           <h2>Doctor Details Form</h2>
            <label for="doctors Name">Doctor's Name:</label>
           <input type="doctorsname" id="doctorsname" name="doctorsname" required>
  
           <label for="specialization">Specialization:</label>
           <input type="specialization" id="specialization" name="Specialization" required>
  
           <button type="button" onclick="submitDoctorDetails()">Submit</button>
      </form>
    </div>
    
    
   <script>
    function showForm(formId) {
    const registrationForm = document.getElementById('registrationForm');
    const appointmentForm = document.getElementById('appointmentForm');
    const doctorForm = document.getElementById('doctorForm');
    const registrationTab = document.getElementById('registrationTab');
    const appointmentTab = document.getElementById('appointmentTab');
    const doctorTab = document.getElementById('DoctorTab');

    if (formId === 'registrationForm') {
      registrationForm.style.display = 'flex';
      appointmentForm.style.display = 'none';
      doctorForm.style.display = 'none';
      registrationTab.style.backgroundColor = '#4caf50';
      appointmentTab.style.backgroundColor = '';
      doctorTab.style.backgroundColor = '';
    } else if (formId === 'appointmentForm') {
      registrationForm.style.display = 'none';
      appointmentForm.style.display = 'flex';
      doctorForm.style.display = 'none';
      appointmentTab.style.backgroundColor = '#4caf50';
      registrationTab.style.backgroundColor = '';
      doctorTab.style.backgroundColor = '';
    } else if (formId === 'doctorForm') {
      registrationForm.style.display = 'none';
      appointmentForm.style.display = 'none';
      doctorForm.style.display = 'flex';
      doctorTab.style.backgroundColor = '#4caf50';
      registrationTab.style.backgroundColor = '';
      appointmentTab.style.backgroundColor = '';
    }
  }

   
  function submitDoctorDetails() {
    const doctorsName = document.getElementById('doctorsname').value;
    const specialization = document.getElementById('specialization').value;

    console.log('Doctor Details:');
    console.log(`Doctor's Name: ${doctorsName}`);
    console.log(`Specialization: ${specialization}`);
    alert('Doctor details submitted successfully!'); 
  }

  
  function calculateAge() {
  const dob = document.getElementById('dob').value;
  const today = new Date();
  const birthDate = new Date(dob);
  let age = today.getFullYear() - birthDate.getFullYear();
  const monthDiff = today.getMonth() - birthDate.getMonth();

  if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
    age--;
    if (age < 0) {
      age = 0; // 
    }
  }

  const ageInput = document.getElementById('age');
  ageInput.value = age;

  const ageMessage = document.getElementById('ageMessage');
  const registrationForm = document.getElementById('registrationForm');
  const nextButton = document.querySelector('#registrationForm button');

  if (age < 14) {
    ageMessage.innerText = 'You must be 14 years or older to register.';
    ageMessage.style.color = 'red';
    nextButton.disabled = true;
  } else {
    ageMessage.innerText = '';
    nextButton.disabled = false;
  }
}
  function submitAppointment() {
    const appointmentDate = document.getElementById('appointmentDate').value;
    const appointmentTime = document.getElementById('appointmentTime').value;
  

    console.log('Appointment Information:');
    console.log(`Appointment Date: ${appointmentDate}`);
    console.log(`Appointment Time: ${appointmentTime}`);
    alert('Appointment submitted successfully!');
  }

  
  function handleBloodTypeChange(value) {
    const otherBloodType = document.getElementById('otherBloodType');
    const otherBloodTypeInput = document.getElementById('otherBloodTypeInput');
  
    if (value === 'Other') {
      otherBloodType.style.display = 'block';
      otherBloodTypeInput.required = true;
    } else {
      otherBloodType.style.display = 'none';
      otherBloodTypeInput.required = false;
    }
}

function nextForm(nextFormId) {
    const registrationForm = document.getElementById('registrationForm');
    const nextForm = document.getElementById(nextFormId);
    const registrationTab = document.getElementById('registrationTab');
    const nextTab = document.getElementById(`${nextFormId}Tab`);
  
    const fullName = document.getElementById('fullName').value;
    const dob = document.getElementById('dob').value;
    const gender = document.getElementById('gender').value;
    const bloodType = document.getElementById('bloodType').value;
  
    const ageInput = document.getElementById('age');
    const age = parseInt(ageInput.value); // Parse age as an integer
  
    if (!fullName || !dob || !gender || !bloodType) {
      alert('Please fill in all required fields before proceeding.');
      return;
    }
  
    if (age < 14 || age < 0) { // Prevent proceeding if age is less than 14 or negative
      alert('Invalid age. Please enter a valid date of birth.');
      return;
    }
  
    registrationForm.style.display = 'none';
    nextForm.style.display = 'flex';
  
    registrationTab.style.backgroundColor = '';
    nextTab.style.backgroundColor = '#4caf50';
  }
   </script> 
   </body>
   </html>
<?php

include_once'templates/footer.php';

?>