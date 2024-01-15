<?php
// get_doctors.php
$speciality = $_POST['speciality'] ?? 'cardiologist'; // Default value for initial load

// Fetch doctors from the database based on the selected speciality
// Replace this with your actual database query
$doctors = ($speciality === 'cardiologist')
    ? ['Dr. Smith', 'Dr. Johnson']
    : ['Dr. Davis', 'Dr. Williams'];
?>
