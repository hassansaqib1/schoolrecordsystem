<!DOCTYPE html>
<html>
<head>
    <title>Update Parent Status</title>
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
        <h2>Update Parent Status</h2>

        <form action="" method="post">
            <label for="parent_id">Enter Parent ID:</label>
            <input type="text" name="parent_id" required>
            <input type="submit" value="Update Status">
        </form>

        <?php
        
        $db_host = 'localhost';
        $db_user = 'adminschool';
        $db_pass = 'password';
        $db_name = 'SchoolManagementSystem';

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['parent_id'])) {
            $parent_id = $_POST['parent_id'];
            
            if (isset($_POST['parent_id'])) {
                $parent_id = $_POST['parent_id'];

                $query = "SELECT * FROM Parent WHERE parent_id = $parent_id";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $updateQuery = "UPDATE Parent SET status = false WHERE parent_id = $parent_id";
                    $updateResult = mysqli_query($conn, $updateQuery);

                    if ($updateResult) {
                        echo "<p class='success-message'>Status of Parent ID: $parent_id has been updated to false.</p>";
                    } else {
                        echo "<p class='error-message'>Failed to update the status of Parent ID: $parent_id.</p>";
                    }
                } else {
                    echo "<p class='error-message'>Parent ID: $parent_id does not exist.</p>";
                }
            }
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>


