<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "form";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $needs = $_POST['message'];

    // Perform basic validation
    if (empty($name) || empty($email) || empty($needs)) {
        header("Location: your_form_page.php?error=All fields are required");
        exit();
    }

    // Insert user query into the 'queries' table
    $insert_query = "INSERT INTO quries (name, email, message) VALUES ('$name', '$email', '$needs')";
    if ($conn->query($insert_query) === TRUE) {
        // Redirect to a success page or back to the form page
        header("Location: index.php");
        exit();
    } else {
        header("Location: your_form_page.php?error=" . urlencode($conn->error));
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
