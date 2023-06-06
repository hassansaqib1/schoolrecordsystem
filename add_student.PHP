
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


function insert_student($conn, $firstName, $lastName, $dob, $phoneNumber, $status, $dateOfJoin, $email, $address, $parentId)
{
    $stmt = $conn->prepare("INSERT INTO Student (first_name, last_name, dob, phone_number, status, date_of_join, email, address, parent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissssi", $firstName, $lastName, $dob, $phoneNumber, $status, $dateOfJoin, $email, $address, $parentId);

    if ($stmt->execute()) {
        $studentId = $stmt->insert_id;
        return $studentId;
    } else {
        return false;
    }
}


$successMessage = "";
$errorMessage = "";
$errorMessage1 = "";
$errorMessage2 = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $dob = $_POST["dob"];
    $phoneNumber = $_POST["phoneNumber"];
    $status = isset($_POST["status"]) ? 1 : 0;
    $dateOfJoin = $_POST["dateOfJoin"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $parentId = $_POST["parentId"];

    if (!is_numeric($phoneNumber) || !is_numeric($parentId)) {
        $errorMessage1 = "Error: Phone number and Parent id should be numeric.";
    } else {
        
        $parentQuery = "SELECT * FROM Parent WHERE parent_id = $parentId";
        $parentResult = $conn->query($parentQuery);

        if ($parentResult->num_rows > 0) {
            
            $studentId = insert_student($conn, $firstName, $lastName, $dob, $phoneNumber, $status, $dateOfJoin, $email, $address, $parentId);

            if ($studentId) {
                $successMessage = "Student information inserted successfully. Student ID: " . $studentId;
            } else {
                $errorMessage = "Error inserting student information.";
            }
        } else {
            $errorMessage2 = "Parent ID: $parentId does not exist.";
        }
    }
}

$conn->close();
?>

    <div class="container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Student Registration Form</h1>

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
<?php if (!empty($errorMessage2)): ?>
    <div class="error-message">
        <?php echo $errorMessage2; ?>
    </div>
<?php endif; ?>


            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" required><br>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" required><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" required><br>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" name="phoneNumber" required><br>

            <label for="status">Status:</label>
            <input type="checkbox" name="status"><br>

            <label for="dateOfJoin">Date of Join:</label>
            <input type="date" name="dateOfJoin" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email"><br>

            <label for="address">Address:</label>
            <input type="text" name="address" required><br>

            <label for="parentId">Parent ID:</label>
            <input type="text" name="parentId"><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>

