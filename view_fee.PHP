<!DOCTYPE html>
<html>
<head>
    <title>View Fee Records</title>
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
        <h2>View fee record</h2>
<div class="button-wrapper">
    <a href="homepage.PHP">Go to Homepage</a>
</div>
    <form method="POST" action="">
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" id="student_id" required>
        <button type="submit" name="submit">Get Fee Records</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $student_id = $_POST['student_id'];
        $db_host = 'localhost';
        $db_user = 'adminschool';
        $db_pass = 'password';
        $db_name = 'SchoolManagementSystem';
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query = "SELECT * FROM Fee WHERE Student_id = $student_id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr><th>Date of Payment</th><th>Status</th><th>Fee Amount</th><th>Generated On</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['date_of_pay'] . '</td>';
                echo '<td>' . ($row['status'] ? 'Paid' : 'Unpaid') . '</td>';
                echo '<td>' . $row['Fee Amount'] . '</td>';
                echo '<td>' . $row['fee_generated_on'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<span style="font-size: 18px; font-weight: bold;">No fee records found for Student ID: ' . $student_id . '</span>';
        }
        mysqli_close($conn);
    }
    ?>
</body>
</html>

