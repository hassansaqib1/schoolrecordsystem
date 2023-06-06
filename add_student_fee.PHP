
<!DOCTYPE html>
<html>
<head>
    <title>Student Fee Payment Form</title>
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $dateOfPay = $_POST['dateOfPay'];
    $studentId = $_POST['studentId'];
    $status = isset($_POST['status']) ? 1 : 0;
    $feeAmount = $_POST['feeAmount'];
    $feeGeneratedOn = $_POST['feeGeneratedOn'];

    
    if (empty($dateOfPay) || empty($studentId) || empty($feeGeneratedOn)) {
        $errorMessage = "Please fill in all the required fields.";
    } else {
        
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
        
        $stmt = $conn->prepare("INSERT INTO Fee (date_of_pay, Student_id, status, `Fee Amount`, fee_generated_on) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiis", $dateOfPay, $studentId, $status, $feeAmount, $feeGeneratedOn);
        $stmt->execute();
                
        if ($stmt->affected_rows > 0) {
            $successMessage = "Data inserted successfully.";
        } else {
            $errorMessage = "Failed to insert data.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
    <div class="container">
        <form method="POST">
            <h2 class="text-center">Student Fee Payment Form</h2>
           
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

            <div>
                <label for="dateOfPay">Date of Payment:</label>
                <input type="date" name="dateOfPay" id="dateOfPay">
            </div>
            <div>
                <label for="studentId">Student ID:</label>
                <input type="text" name="studentId" id="studentId">
            </div>
            <div>
                <label for="status">Status:</label>
                <input type="checkbox" name="status" id="status">
            </div>
            <div>
                <label for="feeAmount">Fee Amount:</label>
                <input type="text" name="feeAmount" id="feeAmount">
            </div>
            <div>
                <label for="feeGeneratedOn">Fee Generated On:</label>
                <input type="date" name="feeGeneratedOn" id="feeGeneratedOn">
            </div>
            <input type="submit" value="Submit">
        </form>
</body>
</html>
