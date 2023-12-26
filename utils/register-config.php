<!-- REFERENCES GOES TO
"https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php" -->
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$emailAddress = $firstName =  $lastName =  $address =  $postcode =  $phoneNo = $password = $confirm_password = "";
$emailAddress_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  // Prepare a select statement
  $sql = "SELECT userID FROM user WHERE emailAddress = ?";

  if ($stmt = $connect->prepare($sql)) {

    // Set parameters
    $param_email = $_POST["emailAddress"];

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_email);

    // Set parameters
    $param_email = $_POST["emailAddress"];

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
      // store result
      $stmt->store_result();

      if ($stmt->num_rows == 1) {
        $emailAddress_err = "This email address is already used.";
      } else {
        $emailAddress = $_POST["emailAddress"];
      }
    } else {
      echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
  }


  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have at least 6 characters!";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }

  // Check input errors before inserting in database
  if (empty($emailAddress_err) && empty($password_err) && empty($confirm_password_err)) {

    // Prepare an insert statement
    $sql = "INSERT INTO user (firstName, lastName, emailAddress, password, address, phoneNo, postcode) VALUES (?,?,?,?,?,?,?)";

    if ($stmt = $connect->prepare($sql)) {
      // Set parameters
      $param_emailAddress = $emailAddress;
      $param_firstName = $_POST["firstName"];
      $param_lastName =  $_POST["lastName"];
      $param_address = $_POST["address"];
      $param_postcode = $_POST["postcode"];
      $param_phoneNo = $_POST["phoneNo"];
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("sssssss", $param_firstName, $param_lastName, $param_emailAddress, $param_password, $param_address, $param_phoneNo, $param_postcode);

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Redirect to login page
        header("location: login.php");
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  // Close connection
  $connect->close();
}
