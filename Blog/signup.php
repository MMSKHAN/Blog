<?php
session_start();
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
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];

    // Perform basic validation
    if (empty($uname) || empty($email) || empty($age) || empty($password) || empty($conpassword)) {
        header("Location: signup.php?error=All fields are required");
        exit();
    }

    // Check if passwords match
    if ($password !== $conpassword) {
        header("Location: signup.php?error=Passwords do not match");
        exit();
    }

    // Check if the email is already registered
    $check_email_query = "SELECT * FROM users WHERE email='$email'";
    $check_email_result = $conn->query($check_email_query);

    if ($check_email_result->num_rows > 0) {
        header("Location: signup.php?error=Email is already registered");
        exit();
    }

    // Hash the password before storing in the database (you should use a stronger hashing method)
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $insert_query = "INSERT INTO users (uname, email, age, password) VALUES ('$uname', '$email', '$age', '$password')";
    if ($conn->query($insert_query) === TRUE) {
        // Redirect to login page on successful registration
        header("Location: login.php");
        exit();
    } else {
        header("Location: signup.php?error=" . urlencode($conn->error));
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>





<!DOCTYPE html>
<html>
<head>
	<title>SIGNUP</title>
	<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body onload="myFunction()">
	<div class="box">
		<form action=" " method="post">
			<h2>Signup Here</h2>
			<input type="text" name="uname" placeholder="User Name"><br>
			<input type="email" name="email" placeholder="Email"><br>
            <input type="number" name="age" placeholder="Age"><br>

			<input type="password" name="password" placeholder="Password"><br>
			<input type="password" name="conpassword" placeholder="Conferm Password"><br>
			<button type="submit">Signup</button>
			<div class="errorstat">
				<?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
				<?php } ?>
			</div>
			<a href="indexpat.php">Already have an account?</a>
			
		</form>
	</div>
	<script>
		function myFunction(){
			document.querySelector(".box").classList.add("box-tog");
		}
	</script>
</body>

</html>