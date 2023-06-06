<?php
$servername = "localhost";
$username = "adminschool";
$password = "password";
$database = "SchoolManagementSystem";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function validateLogin($id, $password) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $password = mysqli_real_escape_string($conn, $password);
    $sql = "SELECT * FROM Admin WHERE admin_id = '$id' AND admin_password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    
    if (validateLogin($id, $password)) {
        header("Location: homepage.php");
        exit();
    } else {
        $error = "Invalid ID or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            background-image: url(background.jpg);
            background-size: cover;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        
        .container {
            display: inline-block;
            margin-top: 200px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
        }
        
        input[type="text"], input[type="password"] {
            width: 200px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
        }
        
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="id" placeholder="Admin ID" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="submit" value="Login">
        </form>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
    </div>
</body>
</html>

