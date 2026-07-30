<?php
// Start the session
session_start();

// Destroy all session data
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Logout</title>
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

  <h1>You have been logged out</h1>
  <p><a href="index.html">Click here to login again</a></p>
</body>
</html>
