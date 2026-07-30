<?php
include 'db.php';

$name = trim($_POST['customer_name']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$event = $_POST['event_name'];
$venue = trim($_POST['venue']);
$date = $_POST['event_date'];
$type = $_POST['ticket_type'];
$ticket_count = (int)$_POST['ticket_count'];
$discount_code = trim($_POST['discount_code']);
$payment = $_POST['payment'];
$notes = trim($_POST['notes']);

if ($name === '' || $phone === '' || $email === '' || $event === '' || $venue === '' || $date === '' || $ticket_count <= 0) {
    die("Error: All required fields must be filled correctly.");
}

// Ticket pricing
switch ($type) {
    case "Regular": $price = 2500; break;
    case "VIP": $price = 5000; break;
    case "VVIP": $price = 10000; break;
    default: die("Invalid ticket type selected.");
}

$total = $ticket_count * $price;
$discount = 0;

// Discount logic
if (strtolower($discount_code) === 'music10') {
    $discount = 0.10 * $total;
} elseif (strtolower($discount_code) === 'vip20') {
    $discount = 0.20 * $total;
}

$vat = 0.16 * $total;
$final_amount = $total - $discount;

// Prevent duplicate booking by email + event
$check = $conn->query("SELECT id FROM tickets WHERE email='$email' AND event_name='$event'");
if ($check->num_rows > 0) {
    die("Error: This email has already booked a ticket for this event.");
}

// Save booking
$sql = "INSERT INTO tickets(customer_name, phone, email, event_name, venue, event_date, ticket_type, quantity, price_per_ticket, discount_code, total_cost, final_amount, payment_method, notes)
VALUES('$name', '$phone', '$email', '$event', '$venue', '$date', '$type', '$ticket_count', '$price', '$discount_code', '$total', '$final_amount', '$payment', '$notes')";

if ($conn->query($sql) === TRUE) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Booking Summary</title>
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

      <h2>Booking Summary</h2>
      <?php
      echo "Name: " . $name . "<br>";
      echo "Phone: " . $phone . "<br>";
      echo "Email: " . $email . "<br>";
      echo "Event: " . $event . "<br>";
      echo "Venue: " . $venue . "<br>";
      echo "Date: " . $date . "<br>";
      echo "Ticket: " . $type . "<br>";
      echo "Quantity: " . $ticket_count . "<br>";
      echo "Price per Ticket: " . $price . "<br>";
      echo "Total: " . $total . "<br>";
      echo "Discount: " . $discount . "<br>";
      echo "VAT: " . $vat . "<br>";
      echo "<strong>Final Payable: " . $final_amount . "</strong><br><br>";
      ?>
      <a href="view.php">View All Bookings</a>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . $conn->error;
}
?>
