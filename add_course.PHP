
<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
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


<?php
// Database connection details
$servername = "localhost";
$username = "adminschool";
$password = "password";
$dbname = "SchoolManagementSystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert course information into the database
function insert_course($conn, $courseId, $courseDescription, $courseName)
{
    $stmt = $conn->prepare("INSERT INTO Course (course_id, course_description, course_name) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $courseId, $courseDescription, $courseName);

    if ($stmt->execute()) {
        $courseId = $stmt->insert_id;
        return $courseId;
    } else {
        return false;
    }
}

// Initialize variables for success and error messages
$successMessage = "";
$errorMessage = "";
$errorMessage1 = "";
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseId = $_POST["courseId"];
    $courseDescription = $_POST["courseDescription"];
    $courseName = $_POST["courseName"];

    if (!is_numeric($courseId) || !is_numeric()) {
            $errorMessage1 = "Error: Course id should be numeric.";
        } else {

    
    
    // Call the insert_course function and check the result
    $courseId = insert_course($conn, $courseId, $courseDescription, $courseName);

    if (!$courseId) {
        $successMessage = "Course information inserted successfully." ;
    } else {
        $errorMessage = "Error inserting course information.";
    }
            }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Registration Form</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Course Registration Form</h1>

<?php if (!empty($successMessage)): ?>
        <div class="success-message">
            <?php echo  $successMessage; ?>
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

            <label for="courseId">Course ID:</label>
            <input type="text" name="courseId" required><br>

            <label for="courseDescription">Course Description:</label>
            <input type="text" name="courseDescription" required><br>

            <label for="courseName">Course Name:</label>
            <input type="text" name="courseName" required><br>

            <input type="submit" value="Submit">

           
        </form>
    </div>
</body>
</html>
