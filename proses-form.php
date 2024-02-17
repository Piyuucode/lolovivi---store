<?php
// Set your database connection details
$host = 'localhost'; // usually 'localhost'
$username = 'root';
$password = '';
$database = 'bananachip';

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required POST keys are set
    if (isset($_POST["name"], $_POST["email"], $_POST["message"])) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Sanitize and get form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        if ($stmt->execute()) {
            echo "Message sent successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Incomplete form data";
    }
} else {
    echo "Invalid request method";
}

// Close the database connection
$conn->close();
?>
