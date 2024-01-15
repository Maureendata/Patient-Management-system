<?php
include_once('cookies.php');


?>
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
    include("navbar.html"); 
    ?>
<div class=dash>
    <div class="container">
        <h2>My Appointments</h2>
        
        <!-- PHP code to fetch and display appointments -->
      

<?php
// Database connection
include("session.php");

// Fetch appointments for a specific person (change the name accordingly)
$name = "othieno paul otieno";
$sql = "SELECT * FROM appointments WHERE name = '$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Phone</th><th>Speciality</th><th>Doctor</th><th>Date</th><th>Time</th>
    <th>Comments</th><th>View</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['speciality']}</td>";
        echo "<td>{$row['doctor']}</td>";
        echo "<td>{$row['date']}</td>";
        echo "<td>{$row['time']}</td>";
        echo "<td>{$row['comments']}</td>";
        
        echo "<td><a href='#' class='btn btn-info btn-lg' style='border-radius:50%; height:50px'>
        <span class='glyphicon glyphicon-eye-open'></span>
      </a>
    </a></td>";
   
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No appointments found.";
}

$conn->close();
?>
  
    </div>
</div>

</body>
</html>
