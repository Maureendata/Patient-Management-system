<?php
session_start();
include("navbar.php");
include("session.php");

$patient_id = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : null;
$user_id = $_SESSION['user_id'];

if ($patient_id && isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Fetch appointment details using the appointment ID
    $sql = "SELECT appointments.*, patients.* 
            FROM appointments
            LEFT JOIN patients ON appointments.patient_id = patients.patient_id
            WHERE patients.patient_id = $user_id AND appointments.appointment_id = $appointmentId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the appointment details
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="appointmentstyles.css" type="text/css">
    <title>Appointment Module</title>
        </head>
        <body>
            <div class="appointment">
                <div class="container">        
                    <h2>Edit Appointment</h2>

                    <form action="editprocess_appointment.php" method="POST">
                        <!-- Display and pre-fill the form fields with the fetched appointment details -->
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" readonly>
                        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone"  value="<?php echo $row['phone'] ?>" > 

        <label for="speciality">Select Doctor's Speciality:</label>
        <select id="speciality" name="speciality"   required>
           
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
            </fieldset>    </fieldset>
        <label for="date">Preferred Date:</label>
        <input type="date" id="appointment_date" name="appointment_date"  value="<?php echo $row['date'] ?>"required>

        <label for="time">Preferred Time:</label>
       <input type="time" id="appointment_time" name="appointment_time" value="<?php echo $row['time'] ?>" required>
       <label for="comments">Additional Comments:</label>
        <textarea id="comments" name="comments" rows="4" ><?php echo $row['comments'] ?></textarea>
        <input type="number" id="appointment_id" name="appointment_id" value="<?php echo $row['appointment_id']; ?>" >
               <button type="submit">Update Appointment</button>                   
                      
                        
                        

                        <!-- ... submit button ... -->
                    </form>
                </div>
            </div>
        </body>
        </html>

        <?php
    } else {
        echo "Appointment not found.";
    }
} else {
    echo "Patient ID or Appointment ID not provided.";
}
?>
