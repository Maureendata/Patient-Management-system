<?php

// Database connection
include("session.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize and validate input data
    function sanitizeInput($data) {
        return htmlspecialchars(trim($data));
    }

    $firstname = sanitizeInput($_POST["firstname"]);
    $lastname = sanitizeInput($_POST["lastname"]);
    $gender = sanitizeInput($_POST["gender"]);
    $dob = sanitizeInput($_POST["dob"]);
    $phone = sanitizeInput($_POST["phone"]);
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Basic validation
    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }

    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }

    if (empty($gender)) {
        $errors[] = "Gender is required.";
    }

    if (empty($dob)) {
        $errors[] = "Date of Birth is required.";
    }

    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }

    if (empty($email)) {
        $errors[] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO patients (firstname, lastname, gender, date_of_birth, phone, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstname, $lastname, $gender, $dob, $phone, $email, $hashed_password);

        // Execute the statement
        $result = $stmt->execute();

        // Check if the execution was successful
        if ($result) {
            echo "Registration successful. Patient record added to the database.";
        } else {
            echo "Error: " . $stmt->error ?? "Unknown error";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

// Close the database connection
$conn->close();

?>
