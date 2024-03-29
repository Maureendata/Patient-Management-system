
<?php
session_start();
include("navbar.php");


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
    <title>Delete Appointment</title>
</head>
<body>

    <div class="appointment">
        <div class="container">   
           
        <h2>Appointment Request</h2>
        
        <form action="deleteprocess_appointment.php" method="POST">

      
          
<table>
       <tr> <td><label for="name">Your Name:</label></td>
        
        
       <td><?php
                 
            echo $row['name'];
                              
        ?> </td></tr>
        <tr>
<td><label>Phone number</label></td>
<td><?php echo $row['phone'] ?></td>

            </tr>
            <tr>
<td><label>Doctor Speciality</label></td>
<td><?php echo $row['speciality'] ?></td>
            </tr>
<tr>
    <td><label>Doctor</label></td>
    <td><?php echo $row['doctor'] ?> </td>
            </tr>
            <tr>
<td><label>Appointment date</label></td>
<td><?php echo $row['date'] ?></td>
            </tr>
    <tr>
        <td><label>Appointment time</label></td>
        <td><?php echo $row['time'] ?></td>
            </tr>
            <tr>
        <td><label>Ailments</label></td>
        <td><?php echo $row['comments'] ?></td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="number" name="appointment_id" value="<?php echo $row['appointment_id']; ?> hidden">
            </td>
            </tr>

        </table>            

        <button type="submit" onclick="confirmDelete()">Delete Appointment</button>   
        


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