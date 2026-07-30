<?php
include 'db.php';

$result = $conn->query("SELECT * FROM students");

echo "<h2>All Students</h2>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Name</th><th>Reg No</th><th>Course</th><th>Total</th><th>Average</th><th>Grade</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['reg_no']."</td>";
    echo "<td>".$row['course']."</td>";
    echo "<td>".$row['total']."</td>";
    echo "<td>".$row['average']."</td>";
    echo "<td>".$row['grade']."</td>";
    echo "</tr>";
}

echo "</table>";
?>
    