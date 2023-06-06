
<!DOCTYPE html>
<html>
<head>
    <title>Add Classroom Form</title>
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
    <div class="button-wrapper">
        <a href="homepage.php">Go to Homepage</a>
    </div>

    <div class="container">


<?php

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $classroomId = $_POST["classroomId"];
    $year = $_POST["year"];
    $status = isset($_POST["status"]) ? 1 : 0;
    $teacherId = $_POST["teacherId"];
    $courseId = $_POST["courseId"];

    if (!is_numeric($classroomId)) {
        $errorMessage1 = "Error: Classroom ID should be numeric.";
    } else {
        
        $teacherQuery = "SELECT * FROM Teacher WHERE teacher_id = $teacherId";
        $teacherResult = $conn->query($teacherQuery);
        if ($teacherResult->num_rows == 0) {
            $errorMessage = "Error: Invalid Teacher ID.";
        } else {
            
            $courseQuery = "SELECT * FROM Course WHERE course_id = $courseId";
            $courseResult = $conn->query($courseQuery);
            if ($courseResult->num_rows == 0) {
                $errorMessage = "Error: Invalid Course ID.";
            } else {
                
                $sql = "INSERT INTO Classroom (classroom_id, year, status, teacher_id, course_id) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iisii", $classroomId, $year, $status, $teacherId, $courseId);

                if ($stmt->execute()) {
                    $successMessage = "Classroom has been inserted.";
                } else {
                    $errorMessage = "Error in inserting classroom information.";
                }

                $stmt->close();
            }
        }
    }
}
$conn->close();
?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Add Classroom Form</h1>
            <label for="classroomId">Classroom ID:</label>

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

            <input type="text" name="classroomId" required><br>

            <label for="year">Year:</label>
            <input type="text" name="year" required><br>

            <label for="status">Status:</label>
            <input type="checkbox" name="status"><br>

            <label for="teacherId">Teacher ID:</label>
            <input type="text" name="teacherId" required><br>

            <label for="courseId">Course ID:</label>
            <input type="text" name="courseId" required><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>

