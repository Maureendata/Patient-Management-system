
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Dashboard</title>
    <link rel="stylesheet" href="dashboardstyle.css">
</head>
<body>
<?php
   include("navbar.php");      

 // Fetch patient_id from the session
 
if ($patient_id) {
     // Fetch appointments for a specific person using the patient_id
     $sql = "SELECT appointments.*, patients.* 
 FROM appointments
 LEFT JOIN patients ON appointments.patient_id = patients.patient_id
 WHERE patients.patient_id = $user_id";
   
?>
<div class="dash">
    <div class="container">
        <h2>My Appointments</h2>
        
        <!-- PHP code to fetch and display appointments -->

        <?php
        // Database connection
       

$result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Name</th><th>Phone</th><th>Speciality</th><th>Doctor</th><th>Date</th><th>Time</th>
                <th>Comments</th><th>Action</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['phone']}</td>";
                    echo "<td>{$row['speciality']}</td>";
                    echo "<td>{$row['doctor']}</td>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['time']}</td>";
                    echo "<td>{$row['comments']}</td>";
                    echo "<td>&nbsp&nbsp&nbsp<a href='edit_appointment.php?id={$row['appointment_id']}' class='btn btn-info btn-lg' 
                    style='border-radius:50%; padding:4px;'>
                        <span class='glyphicon glyphicon-pencil'></span>
                      </a> &nbsp&nbsp&nbsp<a href='delete_appointment.php?id={$row['appointment_id']}' class='btn btn-info btn-lg' 
                      style='border-radius:50%;padding:4px;'>
                      <span class='glyphicon glyphicon-trash'></span>
                    </a>
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No appointments found.";
            }
        } else {
            echo "Session data not found.";
        }

        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
