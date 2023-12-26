<?php
session_start();
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['emailAddress']) && $_SESSION['emailAddress'] === 'admin')) {
  header('Location: user-profile.php');
  exit();
}

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWD = '';
$DB_NAME = 'umami_deliver';

$connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);

if (mysqli_connect_errno()) {
  exit('Error connect to database' . mysqli_connect_error());
}
?>