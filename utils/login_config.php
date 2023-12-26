<?php

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: user-profile.php");
  exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$emailAddress = $password = "";
$emailAddress_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if emailAddress is empty
  $emailAddress = trim($_POST["emailAddress"]);

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if (empty($emailAddress_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT userID, emailAddress, password FROM user WHERE emailAddress = ?";

    if ($stmt = $connect->prepare($sql)) {
      // Set parameters
      $param_emailAddress = $emailAddress;

      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_emailAddress);


      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Store result
        $stmt->store_result();

        // Check if username exists, if yes then verify password
        if ($stmt->num_rows == 1) {
          // Bind result variables
          $stmt->bind_result($userID, $emailAddress, $hashed_password);
          if ($stmt->fetch()) {
            if (password_verify($password, $hashed_password)) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["userID"] = $userID;
              $_SESSION["emailAddress"] = $emailAddress;
              // Redirect user to welcome page
              if($_SESSION["emailAddress"] === 'admin'){
                header("location: admin-profile.php");
              }else{
                header("location: user-profile.php");
              }
            } else {
              // Password is not valid, display a generic error message
              $login_err = "Invalid username or password.";
            }
          }
        } else {
          // Username doesn't exist, display a generic error message
          $login_err = "Invalid username or password.";
        }
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
