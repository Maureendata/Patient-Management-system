
<?php
include_once('cookies.php');
include_once('session.php');
$patient_id = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : null;
$user_id= $_SESSION['user_id'];
$sql = "SELECT * 
 FROM  patients  
 WHERE patients.patient_id = $user_id";


$result = $conn->query($sql);  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Patient Registration</title>
    </head>
    <body>

        <div class="nav">
        <img src="img/hoslogo.avif">
        <p>SPMS</p>
       
  
        <hr/>
        <nav>
            <ul> 
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href= "doctor.php">Doctors</a></li>
                <li><a href="appointment.php">Appointment</a></li>
                <li><a href="profiledisplay.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        </div>
      <div class="header">
            <h3> 
                STINGY PATIENT MANAGEMENT SYSTEM
              <span style="float:right;">  <a href="#" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-user"></span><?php if($result->num_rows>0)
        {
            $row = $result->fetch_assoc();
            echo $row['firstname'];
                } ?> 
                  </a>
                  </span>
            </h3>               
    
    </div>

    </body>
    </html>