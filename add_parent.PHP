<!DOCTYPE html>
<html>
<head>
    <title>Parent Registration Form</title>
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
    <a href="homepage.PHP">Go to Homepage</a>
</div>


  <div class="container">
    <h1 class="heading">Parent Registration Form</h1>


    <form method="POST" action="">
      <label for="first_name">First Name:</label><br>
      <input type="text" name="first_name" required><br><br>

      <label for="last_name">Last Name:</label><br>
      <input type="text" name="last_name" required><br><br>

      <label for="dob">Date of Birth:</label><br>
      <input type="date" name="dob" required><br><br>

      <label for="phone_number">Phone Number:</label><br>
      <input type="text" name="phone_number" required><br><br>

      <label for="address">Address:</label><br>
      <input type="text" name="address" required><br><br>

      <label for="id_card_number">ID Card Number:</label><br>
      <input type="text" name="id_card_number" required><br><br>

      <input type="submit" value="Submit">
    </form>

<?php

$servername = "localhost";
$username = "adminschool";
$password = "password";
$dbname = "SchoolManagementSystem";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $dob = $_POST["dob"];
  $phone_number = $_POST["phone_number"];
  $address = $_POST["address"];
  $id_card_number = $_POST["id_card_number"];

 
  if (!is_numeric($phone_number) || !is_numeric($id_card_number)) {
    echo "<p>Error: Phone number and ID card number should be numeric.</p>";
  } else {

   
    $stmt = $conn->prepare("INSERT INTO Parent (first_name, last_name, dob, phone_number, address, id_card_number) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $first_name, $last_name, $dob, $phone_number, $address, $id_card_number);

    if ($stmt->execute()) {
      $parent_id = $stmt->insert_id;
      echo "<p>Form submitted successfully!</p>";
      echo "<p>Your Parent ID is: $parent_id</p>";
    } else {
      echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
  }
}

$conn->close();
?>



  </div>
</body>
</html>


