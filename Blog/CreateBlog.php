<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $link = "Blogs.php";
    $logins = "logout.php";
} else {
    // If not logged in, redirect to the login page
    $link = "login.php";
    $logins = "login.php";
    exit();
}

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
    $title = $_POST['title'];
    $blog = $_POST['blog'];
    $date = date("Y-m-d H:i:s");

    // Perform basic validation
    if (empty($blog) || empty($title)) {
        header("Location: your_form_page.php?error=All fields are required");
        exit();
    }

    // *** Change the table name to 'bloag' ***
    $insert_query = "INSERT INTO blogs (title, blog, date) VALUES ('$title', '$blog', '$date')";
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






<!DOCTYPE html>
<html>
<head>
	<title>Create Blog</title>
	<link rel="stylesheet" type="text/css" href="home.css">
    <link rel="shortcut icon" href="images/logo.png" />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href='https://fonts.googleapis.com/css?family=Akaya Telivigala' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Akshar' rel='stylesheet'>
</head>
<body>
    <style>

.contants{
    margin-top:11rem;
}.con{
    margin-top:11rem;
    width:100%
}

    </style>
     <a id="Home"></a>
        <div class="cov">
            <div class="header" data-aos="fade-down">
                <div class="headlogo">
                    <a href="/"><img src="images/logo.png" height="75" width="200"></a>
                </div>
                <div class="headbar">
                    <i class="fa-solid fa-xmark xmark" onclick="settmin()"></i>
                    <i class="fa fa-bars bars" onclick="settmax()"></i>
                </div>
                <div class="headmenu">
                    <a href="/blog/index.php#Home">Home</a>
                    <a href="./Blogs.php">Blogs</a>
                    <a href="/blog/index.php#About">About</a>
                    <a href="/blog/index.php#Contacts">Contacts</a>
                    <a href="<?php echo $logins; ?>" class="logout"><?php echo isset($_SESSION['user_id']) ? 'Logout' : 'Login'; ?></a>

                    <div>
                    <i class="fa-solid fa-sun light" onclick="settmode()"></i>
                    <i class="fa-solid fa-moon dark" onclick="settmode()"></i>
                    </div>
                </div>
            </div>
            
           

                <div class="contacts">
         <div class="con" data-aos="fade-left">
                    <form class="con-form" action=" " method="POST">
                        <h1>Create Blog</h1>
                        <input type="text" id="name" placeholder="Title" name="title" required>
                        <textarea id="blog" placeholder="Write your precious thoughts" name="blog" required></textarea>
                        <button type="submit">Send</button>
                    </form>
                
            </div>
        </div>






        <div class="footer">
            <div class="follow">
                <a href="/" target="_blank" class="icon-style fab fa-facebook-f"></a>
                <a href="/" target="_blank" class="icon-style fab fa-instagram"></a>
                <a href="/" target="_blank" class="icon-style fab fa-github"></a>
                <a href="/" target="_blank" class="icon-style fab fa-twitter"></a>
            </div>
            <h1>Created By Muhammad Saud All Rights Reserved</h1>
        </div>

     <!--<h1>Hello, <?php echo $_SESSION['name']; ?></h1>-->
</body>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="home.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        easing: 'ease',
        once: true,
        anchorPlacement: 'middle-bottom',
    });
</script>
</html>
