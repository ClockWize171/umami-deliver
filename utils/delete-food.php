<?php

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWD = '';
$DB_NAME = 'umami_deliver';

$connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);

if (mysqli_connect_errno()) {
  exit('Error connect to database' . mysqli_connect_error());
}
if (isset($_GET['id'])) {
  $foodID = $_GET['id'];
  $error = "";

  // Fetch imageUrl from the database using foodID
  $sql = "SELECT imageUrl FROM foods WHERE foodID = $foodID";
  $result = mysqli_query($connect, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $imageUrl = $row['imageUrl'];

    // Delete the record from the database
    $sqlDelete = "DELETE FROM foods WHERE foodID = $foodID";
    if (mysqli_query($connect, $sqlDelete)) {
      // Delete the image file if it exists
      if (file_exists('.'.$imageUrl)) {
        unlink('.'.$imageUrl);
      } else {
        $error = "Failed to delete image file";
      }

      header('Location: ../admin-profile.php');
    } else {
      $error = "Something went wrong with the deletion";
    }
  } else {
    $error = "Error fetching imageUrl from the database";
  }
}
