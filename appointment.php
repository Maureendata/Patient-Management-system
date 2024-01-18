


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="appointmentstyles.css" type="text/css">
    <title>Appointment Module</title>
</head>
<body>
<?php

    include("navbar.php"); 
    
    ?>
    <div class="appointment">
        <div class="container">        
        <h2>Appointment Request</h2>
        
        <form action="process_appointment.php" method="POST">
        <?php        // Database connection
       
       if ($patient_id) {
            // Fetch appointments for a specific person using the patient_id
            $sql = "SELECT * 
            FROM  patients  
            WHERE patients.patient_id = $user_id";
        

$result = $conn->query($sql);

       }
          ?>          
        
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" value=<?php
        if($result->num_rows>0)
        {
            $row = $result->fetch_assoc();
            echo $row['firstname'];
                } 
                            
        ?> readonly >
        <input type="text" id="name" name="patient_id" value=<?php echo $row['patient_id'] ?> hidden >

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone"  value=<?php echo $row['phone']?>  > 

        <label for="speciality">Select Doctor's Speciality:</label>
        <select id="speciality" name="speciality" required>
            <option value="cardiologist">Cardiologist</option>
            <option value="orthopedic">Orthopedic</option>
            <!-- Add more speciality options as needed -->
        </select>
     <fieldset>
    <legend>Select Doctor:</legend>
     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <label class="custom-tooltip">
      <input type="radio" name="doctor" value="Dr Williams"
       title="Specialty:Orthopedics" style="width:13%;"> Dr Williams      
    </label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <label class="custom-tooltip">
      <input type="radio" name="doctor" value="Dr David" title="Specialty: Orthopedics"
      style="width:13%;"> Dr David      
    </label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <label class="custom-tooltip">
      <input type="radio" name="doctor" value="Dr Smith" title="Specialty: Cardiology"
      style="width:13%;"> Dr Smith      
    </label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

    <label class="custom-tooltip">
      <input type="radio" name="doctor" value="Dr Johnson" title="Specialty: Cardiology"
      style="width:13%;"> Dr Johnson      
    </label>
            </fieldset>
            <!-- Add more speciality options as needed -->
       
        
        <label for="date">Preferred Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" required>

        <label for="time">Preferred Time:</label>
       <input type="time" id="appointment_time" name="appointment_time" required>
       <label for="comments">Additional Comments:</label>
        <textarea id="comments" name="comments" rows="4"></textarea>
        <button type="submit">Submit Appointment</button>
        

</form>

</div>
</div>
</body>
</html>