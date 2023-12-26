<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWD = '';
$DB_NAME = 'umami_deliver';


$connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);

if (mysqli_connect_errno()) {
  exit('Error connect to database' . mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE userID = ?";
$stmt = $connect->prepare($sql);

// Set parameters
$param_userID = $_SESSION["userID"];

// Bind variables to the prepared statement as parameters
$stmt->bind_param("s", $param_userID);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Fetch the data from the result set
while ($row = $result->fetch_assoc()) {
  // Access individual fields using $row["columnName"]
  $userID = $row["userID"];
  $emailAddress = $row["emailAddress"];
  $address = $row["address"];
  $postcode = $row["postcode"];
  $firstName = $row["firstName"];
  $lastName = $row["lastName"];
  $creditCardInfo = $row["creditCardInfo"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve updated values from the form
  $updatedFirstName = $_POST["updatedFirstName"];
  $updatedLastName = $_POST["updatedLastName"];
  $updatedAddress = $_POST["updatedAddress"];
  $updatedPostcode = $_POST["updatedPostcode"];
  $updatedCreditCardInfo = $_POST["updatedCreditCardInfo"];

  // Update user information in the database
  $sql = "UPDATE user SET firstName=?, lastName=?, address=?, postcode=?, creditCardInfo=? WHERE userID=?";
  $stmt = $connect->prepare($sql);
  $stmt->bind_param("ssssss", $updatedFirstName, $updatedLastName, $updatedAddress, $updatedPostcode, $updatedCreditCardInfo, $_SESSION["userID"]);

  if ($stmt->execute()) {
    // Update successful, you might want to redirect to the user profile page
    header("location: user-profile.php");
    exit;
  } else {
    echo "Error updating user information.";
  }

  $stmt->close();
}

// Close the database connection
$connect->close();
