<!DOCTYPE html>
<html>
<head>
  <title>Multi-Part Form</title>
  <style>
    .form-section {
      display: none;
    }
    
    .form-section.current {
      display: block;
    }
    
    .form-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      margin-top: 10px;
    }
    
    .form-button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h2>Multi-Part Form</h2>
  
  <form method="POST" action="process_form.php">
    <div class="form-section current" id="section1">
      <h3>Part 1</h3>
      <label for="name">Name:</label>
      <input type="text" name="name" required><br>
      
      <label for="email">Email:</label>
      <input type="email" name="email" required><br>
      
      <button class="form-button" onclick="nextSection()">Next</button>
    </div>
    
    <div class="form-section" id="section2">
      <h3>Part 2</h3>
      <label for="address">Address:</label>
      <input type="text" name="address" required><br>
      
      <label for="phone">Phone:</label>
      <input type="tel" name="phone" required><br>
      
      <button class="form-button" onclick="previousSection()">Previous</button>
      <button class="form-button" onclick="nextSection()">Next</button>
    </div>
    
    <div class="form-section" id="section3">
      <h3>Part 3</h3>
      <label for="dob">Date of Birth:</label>
      <input type="date" name="dob" required><br>
      
      <label for="gender">Gender:</label>
      <select name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select><br>
      
      <button class="form-button" onclick="previousSection()">Previous</button>
      <button class="form-button" type="submit">Submit</button>
    </div>
  </form>

  <script>
    var currentSection = 0;
    var formSections = document.getElementsByClassName("form-section");
    
    function nextSection() {
      if (currentSection < formSections.length - 1) {
        formSections[currentSection].classList.remove("current");
        currentSection++;
        formSections[currentSection].classList.add("current");
      }
    }
    
    function previousSection() {
      if (currentSection > 0) {
        formSections[currentSection].classList.remove("current");
        currentSection--;
        formSections[currentSection].classList.add("current");
      }
    }
  </script>
</body>
</html>
