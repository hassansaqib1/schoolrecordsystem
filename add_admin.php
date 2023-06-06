
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


// Function to add admin to the database
function add_admin($conn, $firstName, $lastName, $dob, $mobileNumber, $salary, $adminTitle, $adminPassword)
{
    $stmt = $conn->prepare("INSERT INTO Admin (first_name, last_name, dob, mobile_number, salary, admin_title, admin_password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $firstName, $lastName, $dob, $mobileNumber, $salary, $adminTitle, $adminPassword);

    if ($stmt->execute()) {
        $adminId = $stmt->insert_id;
        return $adminId;
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
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $dob = $_POST["dob"];
    $mobileNumber = $_POST["mobileNumber"];
    $salary = $_POST["salary"];
    $adminTitle = $_POST["adminTitle"];
    $adminPassword = $_POST["adminPassword"];

    if (!is_numeric($mobileNumber) || !is_numeric($salary)) {
        $errorMessage1 = "Error: Phone number or salary should be numeric.";
    } else{
    
    // Call the add_admin function and check the result
    $adminId = add_admin($conn, $firstName, $lastName, $dob, $mobileNumber, $salary, $adminTitle, $adminPassword);

    if ($adminId) {
        $successMessage = "Admin added successfully. Admin ID: " . $adminId;
    } else {
        $errorMessage = "Error adding admin.";
    }
        }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin Form</title>
</head>
<body>
    <div class="container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Add Admin Form</h1>
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

            <label for="salary">Salary:</label>
            <input type="text" name="salary" required><br>

            <label for="adminTitle">Admin Title:</label>
            <input type="text" name="adminTitle" required><br>

            <label for="adminPassword">Admin Password:</label>
            <input type="password" name="adminPassword" required><br>

            <input type="submit" value="Submit">

</<body>
</html>
     
