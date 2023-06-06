<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input data
    $classroomId = $_POST['classroomId'];
    $studentId = $_POST['studentId'];

    // Connect to the database
    $servername = "localhost";
    $username = "adminschool";
    $password = "password";
    $dbname = "SchoolManagementSystem";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $successMessage = "";
    $errorMessage = "";
    $errorMessage1 = "";

    // Check if student_id and classroom_id are numeric
    if (!is_numeric($studentId) || !is_numeric($classroomId)) {
        $errorMessage1 = "Error: Student ID and Classroom ID should be numeric.";
    } else {
        // Check if student with given ID exists
        $studentQuery = $conn->prepare("SELECT * FROM Student WHERE student_id = ?");
        $studentQuery->bind_param("i", $studentId);
        $studentQuery->execute();
        $studentResult = $studentQuery->get_result();

        // Check if classroom with given ID exists
        $classroomQuery = $conn->prepare("SELECT * FROM Classroom WHERE classroom_id = ?");
        $classroomQuery->bind_param("i", $classroomId);
        $classroomQuery->execute();
        $classroomResult = $classroomQuery->get_result();

        // Check if both student and classroom exist
        if ($studentResult->num_rows > 0 && $classroomResult->num_rows > 0) {
            // Prepare and execute the SQL query
            $stmt = $conn->prepare("INSERT INTO Classroom_student (Classroom_id, Student_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $classroomId, $studentId);
            $stmt->execute();

            // Check if the insertion was successful
            if ($stmt->affected_rows > 0) {
                $successMessage = "Classroom-Student record added successfully.";
            } else {
                $errorMessage = "Failed to add Classroom-Student record.";
            }
        } else {
            $errorMessage1 = "Error: Student or Classroom does not exist.";
        }

        // Close the result sets
        $studentResult->close();
        $classroomResult->close();

        // Close the statement
        $studentQuery->close();
        $classroomQuery->close();
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Classroom-Student Form</title>
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

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Add Classroom-Student</h1>
        <label for="classroomId">Classroom ID:</label>
        <input type="text" name="classroomId" required><br>
        <label for="studentId">Student ID:</label>
        <input type="text" name="studentId" required><br>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>


