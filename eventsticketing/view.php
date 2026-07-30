<?php
include 'db.php';

if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $conn->query("DELETE FROM tickets WHERE id=$id");
    header("Location: view.php");
    exit;
}

$result = $conn->query("SELECT * FROM tickets");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Bookings</title>
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

  <h2>All Ticket Bookings</h2>
  <table>
    <tr>
      <th>ID</th><th>Name</th><th>Phone</th><th>Email</th>
      <th>Event</th><th>Venue</th><th>Date</th><th>Ticket</th>
      <th>Quantity</th><th>Price</th><th>Total</th><th>Final</th>
      <th>Payment</th><th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['customer_name']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['event_name']; ?></td>
        <td><?php echo $row['venue']; ?></td>
        <td><?php echo $row['event_date']; ?></td>
        <td><?php echo $row['ticket_type']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td><?php echo $row['price_per_ticket']; ?></td>
        <td><?php echo $row['total_cost']; ?></td>
        <td><?php echo $row['final_amount']; ?></td>
        <td><?php echo $row['payment_method']; ?></td>
        <td>
          <a href="update_ticket.php?id=<?php echo $row['id']; ?>">Update</a> | 
          <a href="view.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?')">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>
</html>
