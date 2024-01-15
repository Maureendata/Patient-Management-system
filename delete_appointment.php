
<?php
session_start();
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
<?php
    include("navbar.php"); 
    
    ?>
    <div class="appointment">
        <div class="container">        
        <h2>Appointment Request</h2>
        
        <form action="deleteprocess_appointment.php" method="POST">
        <?php
        // Database connection
       
       if ($patient_id) {
            // Fetch appointments for a specific person using the patient_id
            $sql = "SELECT appointments.*, patients.* 
        FROM appointments
        LEFT JOIN patients ON appointments.patient_id = patients.patient_id where 
        patients.patient_id=$user_id";
        

$result = $conn->query($sql);

       }
          ?>   
          
<table>
       <tr> <td><label for="name">Your Name:</label></td>
        
        
       <td><?php
        if($result->num_rows>0)
        {
            $row = $result->fetch_assoc();
            echo $row['firstname'];
                }               
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
                <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
            </td>
            </tr>


        </table>          
       

        
        <button type="submit">Delete Appointment</button>

</form>

</div>
</div>

</body>
</html>