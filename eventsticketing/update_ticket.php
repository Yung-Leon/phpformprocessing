<?php
include 'db.php';

$id = (int)$_GET['id'];
$result = $conn->query("SELECT * FROM tickets WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['customer_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $event = $_POST['event_name'];
    $venue = $_POST['venue'];
    $date = $_POST['event_date'];
    $type = $_POST['ticket_type'];
    $ticket_count = (int)$_POST['ticket_count'];
    $discount_code = trim($_POST['discount_code']);
    $payment = $_POST['payment'];
    $notes = trim($_POST['notes']);

    // Ticket pricing
    switch ($type) {
        case "Regular": $price = 2500; break;
        case "VIP": $price = 5000; break;
        case "VVIP": $price = 10000; break;
        default: $price = 0;
    }

    $total = $ticket_count * $price;
    $vat = 0.16 * $total;
    $final_amount = $total + $vat; // discount logic can be added if needed

    $sql = "UPDATE tickets SET 
            customer_name='$name', phone='$phone', email='$email', 
            event_name='$event', venue='$venue', event_date='$date', 
            ticket_type='$type', quantity='$ticket_count', 
            price_per_ticket='$price', discount_code='$discount_code', 
            total_cost='$total', final_amount='$final_amount', 
            payment_method='$payment', notes='$notes' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Ticket</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
</head>
<body>
  <nav>
    <a href="index.html">Home</a>
    <a href="create_users.html">Register</a>
    <a href="ticket_form.html">Book Ticket</a>
    <a href="view.php">View Bookings</a>
    <a href="logout.php">Logout</a>
  </nav>

  <h2>Update Ticket</h2>
  <form method="post">
    Name: <input type="text" name="customer_name" value="<?php echo $row['customer_name']; ?>" required><br><br>
    Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

    Event:
    <select name="event_name" id="event_name" onchange="setVenue()" required>
      <option value="">--Select Event--</option>
      <option value="Summer Jam" <?php if($row['event_name']=="Summer Jam") echo "selected"; ?>>Summer Jam</option>
      <option value="Rock Fiesta" <?php if($row['event_name']=="Rock Fiesta") echo "selected"; ?>>Rock Fiesta</option>
      <option value="Jazz Night" <?php if($row['event_name']=="Jazz Night") echo "selected"; ?>>Jazz Night</option>
      <option value="HipHop Live" <?php if($row['event_name']=="HipHop Live") echo "selected"; ?>>HipHop Live</option>
    </select><br><br>

    Venue: <input type="text" name="venue" id="venue" value="<?php echo $row['venue']; ?>" readonly required><br><br>
    Date: <input type="date" name="event_date" value="<?php echo $row['event_date']; ?>" required><br><br>

    Ticket:
    <select name="ticket_type" id="ticket_type" onchange="setPrice()" required>
      <option value="">--Select Ticket Type--</option>
      <option value="Regular" <?php if($row['ticket_type']=="Regular") echo "selected"; ?>>Regular</option>
      <option value="VIP" <?php if($row['ticket_type']=="VIP") echo "selected"; ?>>VIP</option>
      <option value="VVIP" <?php if($row['ticket_type']=="VVIP") echo "selected"; ?>>VVIP</option>
    </select><br><br>

    Price: <input type="text" id="price" name="price" value="<?php echo $row['price_per_ticket']; ?>" readonly><br><br>
    Quantity: <input type="number" name="ticket_count" value="<?php echo $row['quantity']; ?>" min="1" required><br><br>
    Discount: <input type="text" name="discount_code" value="<?php echo $row['discount_code']; ?>"><br><br>

    Payment:
    <input type="radio" name="payment" value="Cash" <?php if($row['payment_method']=="Cash") echo "checked"; ?>> Cash
    <input type="radio" name="payment" value="Card" <?php if($row['payment_method']=="Card") echo "checked"; ?>> Card
    <input type="radio" name="payment" value="Mpesa" <?php if($row['payment_method']=="Mpesa") echo "checked"; ?>> Mpesa<br><br>

    Notes: <textarea name="notes" rows="3" cols="30"><?php echo $row['notes']; ?></textarea><br><br>

    <button type="submit">Update</button>
  </form>
</body>
</html>
