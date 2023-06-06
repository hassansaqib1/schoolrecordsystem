
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

$servername = "localhost";
$username = "adminschool";
$password = "password";
$dbname = "SchoolManagementSystem";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function insert_teacher($conn, $firstName, $lastName, $dob, $mobileNumber, $status, $salary, $address, $teacherField)
{
    $stmt = $conn->prepare("INSERT INTO Teacher (first_name, last_name, dob, mobile_number, status, salary, address, teacher_field) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisss", $firstName, $lastName, $dob, $mobileNumber, $status, $salary, $address, $teacherField);

    if ($stmt->execute()) {
        $teacherId = $stmt->insert_id;
        return $teacherId;
    } else {
        return false;
    }
}
$successMessage = "";
$errorMessage = "";
$errorMessage1 = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $dob = $_POST["dob"];
    $mobileNumber = $_POST["mobileNumber"];
    $status = isset($_POST["status"]) ? 1 : 0;
    $salary = $_POST["salary"];
    $address = $_POST["address"];
    $teacherField = $_POST["teacherField"];

    if (!is_numeric($mobileNumber) || !is_numeric($salary)) {
        $errorMessage1 = "Error: Phone number or salary should be numeric.";
    } else{
    $teacherId = insert_teacher($conn, $firstName, $lastName, $dob, $mobileNumber, $status, $salary, $address, $teacherField);

    if ($teacherId) {
        $successMessage = "Teacher information inserted successfully. Teacher ID: " . $teacherId;
    } else {
        $errorMessage = "Error inserting teacher information.";
    }
        }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Registration Form</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Teacher Registration Form</h1>

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


            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" required><br>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" required><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" required><br>

            <label for="mobileNumber">Mobile Number:</label>
            <input type="text" name="mobileNumber" required><br>

            <label for="status">Status:</label>
            <input type="checkbox" name="status"><br>

            <label for="salary">Salary:</label>
            <input type="text" name="salary" required><br>

            <label for="address">Address:</label>
            <input type="text" name="address" required><br>

            <label for="teacherField">Teacher Field:</label>
            <input type="text" name="teacherField" required><br>

            <input type="submit" value="Submit">
</form>
</div>
</body>
</html>

