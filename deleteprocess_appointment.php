<?php
include("session.php");
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Assuming you have a form field for the appointment ID in your HTML form
    $appointment_id = $_POST["appointment_id"];

    // Basic validation (similar to your existing code)

    if (empty($errors)) {
        // Prepare the DELETE statement
        $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
        $stmt->bind_param("i", $appointment_id);

        // Execute the DELETE statement
        $result = $stmt->execute();

        if ($result) {
            // Redirect to the dashboard after successful deletion
            header("Location: dashboard.php");
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
