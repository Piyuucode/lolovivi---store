<?php
// Start the session to access session variables
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        h1 {
            color: green;
            margin-top: 20%;
        }
        button {
            padding: 7px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            /* Adjust styles for smaller screens */
            h1 {
                margin-top: 50%;
                font-size: 24px;
            }
            button {
                padding: 7px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h1>Transaction Successful!</h1>
    <?php
        // Display the captured name and total amount
        if (isset($_SESSION['transaction_name']) && isset($_SESSION['transaction_total'])) {
            $transactionName = $_SESSION['transaction_name'];
            $transactionTotal = $_SESSION['transaction_total'];

            echo "<p>Thank you, $transactionName, for your order.</p>";
            echo "<p>Your transaction total is: $transactionTotal</p>";

            // Clear the session variables
            unset($_SESSION['transaction_name']);
            unset($_SESSION['transaction_total']);
        } else {
            echo "<p>Transaction data not found.</p>";
        }
    ?>
    <button onclick="goBack()">Back</button>
    <p>Feel free to contact us if you have any questions.</p>

    <script>
        // JavaScript function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
