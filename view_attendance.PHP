<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
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
    <div class="container">
        <h2>View Attendance</h2>
<div class="button-wrapper">
    <a href="homepage.PHP">Go to Homepage</a>
</div>
        <form method="POST">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" required>
            <button type="submit" name="get_attendance">Get Attendance</button>
        </form>
        <?php
        if (isset($_POST['get_attendance'])) {
            $student_id = $_POST['student_id'];
            $conn = mysqli_connect("localhost", "adminschool", "password", "SchoolManagementSystem");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT date, status FROM Attendence WHERE Student_id = $student_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<h3>Attendance Records for Student ID: $student_id</h3>";
                echo "<table>";
                echo "<tr><th>Date</th><th>Status</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . ($row['status'] ? 'Present' : 'Absent') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo '<span style="font-size: 18px; font-weight: bold;">No attendance records found for Student ID: ' . $student_id . '</span>';
            }
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>

