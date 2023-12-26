<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-food'])) {
  // Fetch values from the form
  $foodID = $_POST['foodID'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $featured = isset($_POST['featured']) ? 1 : 0;
  $dietary = $_POST['dietary'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $rating = $_POST['rating'];
  $prepTime = $_POST['prepTime'];

  // Use prepared statement to handle single quotes
  $sql_update_food = "UPDATE foods SET name=?, description=?, rating=?, price=?, prepTime=?, category=?, dietary=?, featured=? WHERE foodID=?";
  $stmt = mysqli_prepare($connect, $sql_update_food);

  // Bind parameters
  mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $description, $rating, $price, $prepTime, $category, $dietary, $featured, $foodID);

  // Execute the statement
  if (mysqli_stmt_execute($stmt)) {
    header('Location: admin-profile.php');
    exit();
  } else {
    $error = "Error updating the food.";
  }
} else {
  $error = "Invalid form submission.";
}

// Fetch current data by id
$id = $_GET['id'];
$name = $description = $featured = $imageUrl = $dietary = $category = $price = $rating = $prepTime = "";
$error = "";
$sql = "SELECT * FROM foods WHERE foodID=?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($data = mysqli_fetch_array($result)) {
  $name = $data['name'];
  $description = $data['description'];
  $imageUrl = $data['imageUrl'];
  $featured = $data['featured'];
  $dietary = $data['dietary'];
  $category = $data['category'];
  $price = $data['price'];
  $rating = $data['rating'];
  $prepTime = $data['prepTime'];
}

?>
