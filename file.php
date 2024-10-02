<?php
// Establish database connection
$servername = "localhost";
$username = "root"; // Change if you have a different username
$password = ""; // Change if you have set a password
$dbname = "book_movie_show";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch user input from the signup form
    $Cust_id = $_POST['Cust_id'];
    $F_name = $_POST['F_name'];
    $L_name = $_POST['L_name'];
    $Age = $_POST['Age'];
    $Mobile_No = $_POST['Mobile_No'];
    $E_mail = $_POST['E_mail'];

    // Prepare and bind the SQL statement
    $sql = "INSERT INTO users (Cust_id, First_Name, Last_Name, Age, Mobile_No, Email) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in preparing the statement: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssss", $Cust_id, $F_name, $L_name, $Age, $Mobile_No, $E_mail);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
