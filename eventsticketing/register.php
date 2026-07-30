<?php
include "db.php";

$fullnames = $_POST['fullnames'];
$username  = $_POST['username'];
$password  = md5($_POST['password']); 
$email     = $_POST['email'];

$checkusername = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($checkusername) > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Registration Error</title>
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
      <p>Sorry, that username already exists. Please go back and choose another.</p>
    </body>
    </html>
    <?php
} else {
    $registerquery = mysqli_query($conn, "INSERT INTO users (fullnames, username, password, email)
        VALUES('$fullnames','$username','$password','$email')");

    if ($registerquery) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
          <title>Registration Success</title>
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
          <p>Your account was created. <a href="index.html">Click here to login</a>.</p>
        </body>
        </html>
        <?php
    } else {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
          <title>Registration Error</title>
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
          <p>Registration failed. Please try again.</p>
        </body>
        </html>
        <?php
    }
}
?>
