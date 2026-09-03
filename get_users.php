<?php
// Include the database connection file
include 'db_connect.php';

// Select all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Initialize an array to store user data
    $users = array();

    // Fetch all users
    while($row = $result->fetch_assoc()) {
        // Add each user data to the array
        $users[] = array(
            'id' => $row["id"],
            'firstname' => $row["firstname"],
            'lastname' => $row["lastname"]
        );
    }

    // Encode the array as JSON and echo it
    echo json_encode($users);
} else {
    // If no results, echo 0
    echo json_encode(0);
}

// Close the database connection
$conn->close();
?>