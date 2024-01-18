<?php
// Start the session
session_start();

// Database connection
include("session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["login_email"];
    $password = $_POST["login_password"];

    // prepare and bind
    $sql = "SELECT patient_id, password FROM patients WHERE email=?";
    $stmt = $conn -> prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt -> execute();
    $result = $stmt->get_result();  

    if ($result->num_rows == 1) {
        // Fetch the row
        $row = $result->fetch_assoc();
        // Accessing the hashed password
       $hashedPasswordFromDatabase = $row["password"];

        //if (password_verify($row["password"], $hashedPasswordFromDatabase)) {
            // Password is correct, set session variables
            // Replace 'user_id' with the actual column name for user ID in your table
            $_SESSION['loggedin']=true;
            $_SESSION['user_id'] = $row['patient_id'];
            echo '<script>alert("Login successfully!");</script>';
            echo '<script>window.location.href = "dashboard.php";</script>';
           // echo '<script>window.alert("Login successfully!");</script>';
            //header("Location: dashboard.php"); // Redirect to the dashboard or any other page
          
        //} else {
           //echo "Incorrect password";
        }
    //} else {
       // echo "Email not found";
    //}

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
