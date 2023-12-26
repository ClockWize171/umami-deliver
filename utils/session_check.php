<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

// Check if the user has the 'admin' role
if (isset($_SESSION['emailAddress']) && $_SESSION['emailAddress'] === 'admin') {
  // Redirect the admin to the admin dashboard or another appropriate page
  header("location: admin-profile.php");
  exit;
}
