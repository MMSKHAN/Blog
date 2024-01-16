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
// Initialize the result variable
$result = null;

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "form";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// SQL query to fetch blogs
$query = "SELECT id, title, blog, date FROM blogs";
$result = mysqli_query($conn, $query);

// Check for errors in the query
if (!$result) {
    echo "Error: " . mysqli_error($conn);
} else {
    // Close the database connection
    $conn->close();
}
?>






<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
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
     <a id="Home"></a>
        <div class="cov">
            <div class="header" data-aos="fade-down">
                <div class="headlogo">
                    <a href="/index.php"><img src="./images/logo.png" height="75" width="200"></a>
                </div>
                <div class="headbar">
                    <i class="fa-solid fa-xmark xmark" onclick="settmin()"></i>
                    <i class="fa fa-bars bars" onclick="settmax()"></i>
                </div>
                <div class="headmenu">
                    <a href="#Home">Home</a>
                    <a href="./Blogs.php">Blogs</a>
                    <a href="#About">About</a>
                    <a href="#Contacts">Contacts</a>
                    <a href="<?php echo $logins; ?>" class="logout"><?php echo isset($_SESSION['user_id']) ? 'Logout' : 'Login'; ?></a>

                    <div>
                    <i class="fa-solid fa-sun light" onclick="settmode()"></i>
                    <i class="fa-solid fa-moon dark" onclick="settmode()"></i>
                    </div>
                </div>
            </div>

            <div class="banner">
                <div class="motto" data-aos="fade-right">
                    <h1>NEVER STOP TO</h1>
                    <h2>TELL THE WORLD</h2>
                    <p>We help people to find the best and preferable visiting spots all over World.</p>
                    <p>Lorem Ipsum Dolor Sit Amrt Consecutor Adipisocing Eit SIt Consequuntor?</p>
                    <button ><a href=" <?php echo $link; ?>" class="btn ">Explore</a></button>
                </div>
            </div>
        </div>

        <a id="services"></a>
        <div class="headline">
            <h1 class="fir">Best &nbsp;</h1>
            <h1 class="sec">Blogs</h1>
        </div>

        <div class="place-bar" data-aos="fade-left">
        <div class="srvcmenu">
    <?php
    // Check if $result is not null before attempting to fetch data
    if ($result) {
        $blogCount = 0; // Initialize a counter variable

        while ($row = mysqli_fetch_assoc($result)) :
            $blogCount++;

            if ($blogCount > 3) {
                break; // Exit the loop if more than three blogs have been fetched
            }
    ?>
            <div class="srvc">
                <small style="float: inline-start; margin-left: 2rem;"><?php echo $row['date']; ?></small>
                <h2><?php echo $row['title']; ?></h2>
                <?php
                $blogContent = $row['blog'];
                $words = str_word_count($blogContent, 1); // Split the words
                $shortenedContent = implode(' ', array_slice($words, 0, 20)); // Take the first 20 words
                ?>
                <p><?php echo $shortenedContent; ?> <a href="./ReadBlogs.php?id=<?php echo $row['id']; ?>" style="color:red;">Read More</a></p>
            </div>
    <?php
        endwhile;
    } else {
        echo "No data available."; // Display a message when there is no data
    }
    ?>
</div>

    </div>
        </div>

        <a id="About"></a>
        <div class="headline">
            <h1 class="fir">ABOUT &nbsp;</h1>
            <h1 class="sec">US</h1>
        </div>
        <div class="about" data-aos="fade-right">
            <div class="ab" >
                <h1>What Makes Us Special?</h1>
                <p>tera yakin kyon maine kiya nahi, tujhse raah kyon juda mujh pe yeh zindagi karti rahi sitam une hi di hai panah </p>
                <p>mera rishta puraana. hai kya tadap,hai yeh kaisi saza tu kyun mujhe aaj yaad aa gaya bechain</p>
                <p> din mere, bechain raat hai kya main karu kuchh bata yeh mere paanv hi khud<</p>
            </div>
            <img src="images/pen.jpg" alt="Girl in a jacket" width="500" height="450" class="abtImg" >

        </div>
        

        <a id="Contacts"></a>
        <div class="headline">
            <h1 class="fir">CONTACT &nbsp;</h1>
            <h1 class="sec">US</h1>
        </div>
        <div class="contacts">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13800.548212863761!2d71.443562!3d30.1474974!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393b31170593881d%3A0x90d09c94962b2464!2sMuhammad%20Nawaz%20Sharif%20University%20of%20Agriculture%2CMultan!5e0!3m2!1sen!2s!4v1704292000506!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>   
        <div class="con" data-aos="fade-left">
                    <form class="con-form" action="./message.php" method="POST">
                        <h1>GET IN TOUCH</h1>
                        <input type="text" id="name" placeholder="Your Name" name="name" required>
                        <input type="email" id="email" placeholder="Your Emaiil" name="email" required>
                        <textarea id="message" placeholder="Your Needs" name="message" required></textarea>
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
