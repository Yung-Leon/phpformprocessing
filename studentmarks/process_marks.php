<?php
include 'db.php';

$name = trim($_POST['student_name'] ?? '');
$reg_no = trim($_POST['reg_no'] ?? '');
$course = trim($_POST['course_title'] ?? '');
$marks = [
    (int)($_POST['unit1'] ?? 0),
    (int)($_POST['unit2'] ?? 0),
    (int)($_POST['unit3'] ?? 0),
    (int)($_POST['unit4'] ?? 0)
];

// basic validation
if ($name === '' || $reg_no === '' || $course === '') {
    die("Error: All fields must be filled.");
}
if (in_array(0, $marks, true)) {
    die("Error: All units must have marks between 1 and 100.");
}

$total = array_sum($marks);
$average = $total / count($marks);

if ($average < 50) $grade = "Fail";
elseif ($average < 60) $grade = "Pass";
elseif ($average < 70) $grade = "Credit";
else $grade = "Distinction";

// prevent duplicates by reg_no
$sql = "SELECT id FROM students WHERE reg_no='$reg_no'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    die("Error: A student with this Reg No already exists.");
}

$sql = "INSERT INTO students(name, reg_no, course, total, average, grade) 
VALUES('$name', '$reg_no', '$course', '$total','$average','$grade')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Results</h2>";
    echo "Name: $name <br>Reg No: $reg_no <br>Course: $course <br>";
    echo "Total: $total <br>Average: $average <br>Grade: $grade <br>";
    echo "<a href='students.php'>View All Students</a>";
} else {
    echo "Error: " . $conn->error;
}
?>
