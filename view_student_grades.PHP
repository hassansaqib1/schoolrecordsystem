
<!DOCTYPE html>
<html>
<head>
    <title>View Grades and Courses</title>
    <style>
        table {
            margin: 0 auto;
            width: 80%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }

        span.no-grades {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
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
          margin: 5px;
      }
      input[type="submit"] {
          font-size: 18px;
          font-weight: bold;
          padding: 10px 20px;
          margin-top: 10px;
      }

    </style>
</head>
<body>
    <div class="button-wrapper">
        <a href="homepage.php">Go to Home Page</a>
    </div>
<div class="container">
    <h2>View Grades and Courses</h2>

<?php
$db_host = 'localhost';
$db_user = 'adminschool';
$db_pass = 'password';
$db_name = 'SchoolManagementSystem';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $query = "SELECT Grades.Grade, Course.course_id, Course.course_name
              FROM Grades
              INNER JOIN Course ON Grades.Course_id = Course.course_id
              WHERE Grades.Student_id = $student_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr><th>Grade</th><th>Course ID</th><th>Course Name</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td >' . $row['Grade'] . '</td>';
            echo '<td>' . $row['course_id'] . '</td>';
            echo '<td>' . $row['course_name'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<span class="no-grades">No grades and courses found for the student with ID: ' . $student_id . '.</span>';
    }
}
mysqli_close($conn);
?>
    <form action="" method="post">
        <label for="student_id">Enter Student ID:</label>
        <input type="text" name="student_id" required>
        <input type="submit" value="Get Grades and Courses">
    </form>
</div>
</body>
</html>

