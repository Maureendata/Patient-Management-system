<?php

if ($patient_id) {
    $sql = "SELECT * 
            FROM  patients  
            WHERE patients.patient_id = $user_id";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>User Profile</h2>";
            echo "<table>";

            echo "<tr><td><strong>First Name</strong></td><td>" . $row["firstname"] . "</td></tr>";
            echo "<tr><td><strong>Last Name</strong></td><td>" . $row["lastname"] . "</td></tr>";
            echo "<tr><td><strong>Gender</strong></td><td>" . $row["gender"] . "</td></tr>";
            echo "<tr><td><strong>Date of Birth</strong></td><td>" . $row["date_of_birth"] . "</td></tr>";
            echo "<tr><td><strong>Phone Number</strong></td><td>" . $row["phone"] . "</td></tr>";
            echo "<tr><td><strong>Email Address</strong></td><td>" . $row["email"] . "</td></tr>";

            echo "</table>";
        } else {
            echo "No user records found for $user_id.";
        }
    } else {
        echo "Error in SQL query: " . $conn->error;
    }
} else {
    echo "Session data not found.";
}

$conn->close();
?>
