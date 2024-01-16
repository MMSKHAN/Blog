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
    <title>BLOG</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='https://fonts.googleapis.com/css?family=Akaya Telivigala' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Akshar' rel='stylesheet'>
</head>

<body>
    <style>
        .place-bar {
            margin-top: 20vh;
            border-radius: 8px;
            height: fit-content;
        }

        .srvcmenu {
            display: flex;
            gap: 2rem;
            flex-direction: column;
            width: 93%
        }

        .srvc {
            margin-top: 2rem;
            margin-bottom: 1rem;
            height: fit-content;
            width: inherit;
            display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
        }

        .blogs {
            position: absolute;
            top: 96px;
            right: 2px;
            background: #e08787;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            text-decoration: none;
            color: black;
            border-radius: 8px;
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
                <a href="/blog/index.php#Home.php">Home</a>
                <a href="/blog/blogs.phps">Blogs</a>
                <a href="/blog/index.php#About">About</a>
                <a href="/blog/index.php#Contacts">Contacts</a>
                <a href="<?php echo $logins; ?>"
                    class="logout"><?php echo isset($_SESSION['user_id']) ? 'Logout' : 'Login'; ?></a>

                <div>
                    <i class="fa-solid fa-sun light" onclick="settmode()"></i>
                    <i class="fa-solid fa-moon dark" onclick="settmode()"></i>
                </div>
            </div>
        </div>

        <a href="./CreateBlog.php" class="blogs "> + Create Blog</a>

        <div class="place-bar">
    <div class="srvcmenu">
        <?php
        // Check if $result is not null before attempting to fetch data
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) :
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
<div class="footer">
            <div class="follow">
                <a href="/" target="_blank" class="icon-style fab fa-facebook-f"></a>
                <a href="/" target="_blank" class="icon-style fab fa-instagram"></a>
                <a href="/" target="_blank" class="icon-style fab fa-github"></a>
                <a href="/" target="_blank" class="icon-style fab fa-twitter"></a>
            </div>
            <h1>Created By Muhammad Saud All Rights Reserved</h1>
        </div>

    <script src="home.js"></script>
</body>

</html>
