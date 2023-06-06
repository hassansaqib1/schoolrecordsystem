<!DOCTYPE html>
<html>
<head>
    <title>View Parents</title>
    <style>
        table {
            margin: 0 auto;
            width: 80%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }

        span.no-parents {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
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
    </style>
</head>
<body>
    <div class="button-wrapper">
        <a href="homepage.php">Go to Home Page</a>
    </div>
    <h2>View Parents</h2>
    <?php
    $db_host = 'localhost';
    $db_user = 'adminschool';
    $db_pass = 'password';
    $db_name = 'SchoolManagementSystem';
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "SELECT * FROM Parent";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
    
        echo '<table>';
        echo '<tr><th>Parent ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Phone Number</th><th>Address</th><th>ID Card Number</th></tr>';
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['parent_id'] . '</td>';
            echo '<td>' . $row['first_name'] . '</td>';
            echo '<td>' . $row['last_name'] . '</td>';
            echo '<td>' . $row['dob'] . '</td>';
            echo '<td>' . $row['phone_number'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '<td>' . $row['id_card_number'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<span class="no-parents">No parents found.</span>';
    }
    mysqli_close($conn);
    ?>
</body>
</html>

