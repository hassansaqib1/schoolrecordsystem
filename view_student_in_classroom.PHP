<!DOCTYPE html>
<html>
  <head>
    <title>View Students in Classroom</title>

<style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0px 0px 5px #888;
            width: 50%;
        }
        .text-center {
            text-align: center;
        }
        .button-wrapper {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .button-wrapper a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }
        label {
            font-size: 18px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="checkbox"] {
            font-size: 16px;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .success-message {
            color: green;
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
  </head>
  <body>
<div class="container">
<div class="button-wrapper">
      <a href="homepage.php">Go to Home Page</a>
  </div>
    <h1>View Students in Classroom</h1>

<?php

$servername = "localhost";
$username = "adminschool";
$password = "password";
$dbname = "SchoolManagementSystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$classroomId = $_GET['classroomId'] ?? $_POST['classroomId'] ?? '';

if (!empty($classroomId)) {
   
    $stmt = $conn->prepare("SELECT Student_id FROM Classroom_student WHERE Classroom_id = ?");
    $stmt->bind_param("i", $classroomId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Students in Classroom $classroomId:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $studentId = $row['Student_id'];
            echo "<li>Student ID: $studentId</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No students found in Classroom $classroomId.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Classroom ID is required.</p>";
}

$conn->close();
?>
    <form method="GET" action="view_students.php">
      <label for="classroom_id">Classroom ID:</label>
      <input type="text" id="classroom_id" name="classroom_id"><br><br>
      <input type="submit" value="View Students">
    </form>

</div>
  </body>
</html>

