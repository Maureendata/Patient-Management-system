<?php
include("session.php");
$errors=[];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function sanitizeInput($data)
    {
        return htmlspecialchars(trim($data));
    }
    $appointment_id=$_POST["appointment_id"];
    $name = $_POST["name"];
    $phone = sanitizeInput($_POST["phone"]);
    $speciality = sanitizeInput($_POST["speciality"]);
    $doctor = sanitizeInput($_POST["doctor"]);
    $date = sanitizeInput($_POST["appointment_date"]);
    $time = sanitizeInput($_POST["appointment_time"]);
    $comments = sanitizeInput($_POST["comments"]);

    // Basic validation (similar to your existing code)

    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE appointments SET name=?, phone=?, speciality=?, 
        doctor=?, date=?, time=?, comments=? WHERE appointment_id=?");
        
       $stmt->bind_param("sssssssi", $name, $phone, $speciality, $doctor, $date, $time, 
        $comments, $appointment_id);

        

        $result = $stmt->execute();
       

        if ($result) {
    //echo "Records updated successfully the new comment is".$comments;
        
    echo '<script>alert("Appointment updated successfully!");</script>';
    echo '<script>window.location.href = "dashboard.php";</script>';   
  
            exit();
        } else {
            echo "Error: " . $stmt->error ?? "Unknown error";
        }

        // Close the statement
        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

$conn->close();
?>
