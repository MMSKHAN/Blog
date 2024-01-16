
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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform basic validation
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=Email and password are required");
        exit();
    }

    // Retrieve user data from the database
    $check_user_query = "SELECT * FROM users WHERE email='$email'";
    $check_user_result = $conn->query($check_user_query);

    if ($check_user_result->num_rows > 0) {
        $user_data = $check_user_result->fetch_assoc();

        // Verify the password
        if ($password === $user_data['password']) {
            // Successful login, set the session variable
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['name'] = $user_data['uname'];

            // Redirect to a dashboard or home page
            header("Location: index.php");
            exit();
        } else {
            // Password doesn't match
            header("Location: login.php?error=Incorrect password");
            exit();
        }
    } else {
        // User not found
        header("Location: login.php?error=User not found");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>




<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body onload="myFunction()">
	<div class="box">
		<form action="login.php" method="post">
			<h2 >Login Here</h2>
			
			<!--<label>User Name</label>-->
			<input type="email" name="email" placeholder="Email"><br>

			<!--<label>User Name</label>-->
			<input type="password" name="password" placeholder="Password"><br>

			<button type="submit">Login</button>
			<div class="errorstat">
				<?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
				<?php } ?>
			</div>
			<a href="signup.php" class="gosignup" >Don't have an account?</a><br/>
		</form>
	</div>

	<script>
		function myFunction(){
			
			document.querySelector(".box").classList.add("box-tog");
		}
	</script>
</body>

</html>