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
    // Sanitize and get form data
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $menu = mysqli_real_escape_string($conn, $_POST["menu"]);
    $quantity = intval($_POST["quantity"]);
    $total = $quantity * 5; // Assuming each item costs 5 units, adjust as needed

    // Insert data into the transactions table
    $sql = "INSERT INTO transaksi (name, address, menu, quantity, total) VALUES ('$name', '$address', '$menu', $quantity, $total)";

    if ($conn->query($sql) === TRUE) {
        // Store data in session variables
        session_start();
        $_SESSION['transaction_name'] = $name;
        $_SESSION['transaction_total'] = $total;
    
        // Redirect to the success page
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }    
} else {
    echo "Invalid request method";
}

// Close the database connection
$conn->close();
?>
