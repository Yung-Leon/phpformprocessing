<?php
include "db.php";

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); 

    $checklogin = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($checklogin) == 1) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
          <title>Login Success</title>
          <link rel="stylesheet" href="style.css">
        </head>
        <body>
          <nav>
            <a href="index.html">Home</a>
            <a href="create_users.html">Register</a>
            <a href="ticket_form.html">Book Ticket</a>
            <a href="view.php">View Bookings</a>
            <a href="logout.php">Logout</a>
          </nav>

          <h1>Success</h1>
          <p>You are logged in as: <?php echo $username; ?></p>
          <a href="ticket_form.html">Book Tickets</a><br><br>
          <a href="view.php">View Bookings</a>
        </body>
        </html>
        <?php
    } else {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
          <title>Login Error</title>
          <link rel="stylesheet" href="style.css">
        </head>
        <body>
          <nav>
            <a href="index.html">Home</a>
            <a href="create_users.html">Register</a>
            <a href="ticket_form.html">Book Ticket</a>
            <a href="view.php">View Bookings</a>
            <a href="logout.php">Logout</a>
          </nav>

          <h1>Error</h1>
          <p>Invalid username or password. <a href="index.html">Try again</a>.</p>
        </body>
        </html>
        <?php
    }
} else {
    echo "Please enter both username and password.";
}
?>
