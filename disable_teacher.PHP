<!DOCTYPE html>
<html>
<head>
    <title>Update Teacher Status</title>
</head>

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


<body>
    <h2>Update Teacher Status</h2>

<form action="" method="post">
    <label for="teacher_id">Enter Teacher ID:</label>
    <input type="text" name="teacher_id" required>
    <input type="submit" value="Update Status">

</form>
<br><br>
<?php
$db_host = 'localhost';
$db_user = 'adminschool';
$db_pass = 'password';
$db_name = 'SchoolManagementSystem';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];
    $query = "SELECT * FROM Teacher WHERE teacher_id = $teacher_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $updateQuery = "UPDATE Teacher SET status = false WHERE teacher_id = $teacher_id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            echo "Status of Teacher ID: $teacher_id has been updated to false.";
        } else {
            echo "Failed to update the status of Teacher ID: $teacher_id.";
        }
    } else {
        echo "Teacher ID: $teacher_id does not exist.";
    }
}
mysqli_close($conn);
?>
</body>
</html>

