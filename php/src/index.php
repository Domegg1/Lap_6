<?php
$servername = "db"; // ชื่อตามที่ระบุใน docker-compose.yml
$username = "root";
$password = "321341";
$database = "students";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// คำสั่ง SQL สำหรับ INNER JOIN
$sql = "SELECT student.student_id, student.full_name, major.major_name 
        FROM student 
        INNER JOIN major ON student.major_id = major.major_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 40px;
        }
        h2 {
            color: #C62300;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #C890A7;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>

<h2>Student List</h2>

<?php
if ($result->num_rows > 0) {
    echo "<table><tr><th>Student_ID</th><th>Full_Name</th><th>Major Name</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["student_id"] . "</td><td>" . $row["full_name"] . "</td><td>" . $row["major_name"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No results found</p>";
}
$conn->close();
?>

</body>
</html>
