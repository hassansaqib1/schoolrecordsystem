<!DOCTYPE html>
<html>
<head>
    <title>Add Grade Form</title>
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
    <a href="homepage.PHP">Go to Homepage</a>
</div>
<div class="container">


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $Grade = $_POST['Grade'];
    $studentId = $_POST['studentId'];
    $Course_id = $_POST['Course_id'];

    
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

    if (!is_numeric($studentId) || !is_numeric($Course_id)) {
        $errorMessage1 = "Error: Student id and Course id should be numeric.";
    } else {
    
       
        $stmt = $conn->prepare("INSERT INTO Grades (Grade, Student_id, Course_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $Grade, $studentId, $Course_id);
        $stmt->execute();

        
        if ($stmt->affected_rows > 0) {
            $successMessage = "Grade record added successfully.";
        } else {
            $errorMessage = "Failed to add Grade record.";
        }
    }

    
    $stmt->close();

   
    $conn->close();
}
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h1>Grade Registration Form</h1>
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
            <label for="Grade">Grade Date:</label>
            <input type="Text" name="Grade" required><br>

            <label for="studentId">studentId:</label>
            <input type="text" name="studentId" required><br>

            <label for="Course_id">Course_id:</label>
            <input type="Text" name="Course_id"><br>

            <input type="submit" value="Submit">
</form>

</div>
</body>
</html>

