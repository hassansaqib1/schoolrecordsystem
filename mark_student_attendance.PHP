<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $attendanceDate = $_POST['attendanceDate'];
    $studentId = $_POST['studentId'];
    $status = isset($_POST['status']) ? 1 : 0;

    
    $servername = "localhost";
    $username = "adminschool";
    $password = "password";
    $dbname = "SchoolManagementSystem";

    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $successMessage = "";
    $errorMessage = "";
    $errorMessage1 = "";

    
    $studentQuery = "SELECT * FROM Student WHERE Student_id = ?";
    $studentStmt = $conn->prepare($studentQuery);
    $studentStmt->bind_param("i", $studentId);
    $studentStmt->execute();
    $studentResult = $studentStmt->get_result();

    if ($studentResult->num_rows === 0) {
        $errorMessage1 = "Invalid student ID.";
    } else {
       
        $stmt = $conn->prepare("INSERT INTO Attendence (date, Student_id, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $attendanceDate, $studentId, $status);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $successMessage = "Attendance record added successfully.";
        } else {
            $errorMessage = "Failed to add attendance record.";
        }
        $stmt->close();
    }
    $studentStmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Attendence</title>
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
<div class="button-wrapper">
       <a href="homepage.php">Go to Homepage</a>
   </div>

    <div class="container">

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Student Attendence</h1>

<?php if (!empty($successMessage)): ?>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errorMessage)): ?>
        <div class="error-message">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

<?php if (!empty($errorMessage1)): ?>
    <div class="error-message">
        <?php echo $errorMessage1; ?>
    </div>
<?php endif; ?>


            <label for="attendanceDate">attendance Date:</label>
            <input type="date" name="attendanceDate" required><br>

            <label for="studentId">studentId:</label>
            <input type="text" name="studentId" required><br>

            <label for="status">Status:</label>
            <input type="checkbox" name="status"><br>

            <input type="submit" value="Submit">
</form>
</div>
</body>
</html>

