<?php
define('MB', 1048576);

if (isset($_POST['add-food'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $featured = isset($_POST['featured']) ? $_POST['featured'] : 0;
  $dietary = $_POST['dietary'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $rating = $_POST['rating'];
  $prepTime = $_POST['prepTime'];

  if (isset($_FILES['imageUrl'])) {
    $image = $_FILES['imageUrl'];
    $imageName = $image['name'];
    $imageSize = $image['size'];
    $tmpName = $image['tmp_name'];
    $imageError = $image['error'];
    $error = "";

    if ($imageError === 0) {
      if ($imageSize > 5 * MB) {
        $error = "File size is too big. Not more than 5 MB";
      } else {
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $imageExtensionLower = strtolower($imageExtension);

        $allowedExtensions = array("jpg", "jpeg", "png");

        if (in_array($imageExtensionLower, $allowedExtensions)) {
          $newImageName = uniqid("img-", true) . '.' . $imageExtensionLower;
          $uploadPath = './upload/' . $newImageName;
          move_uploaded_file($tmpName, $uploadPath);

          // Use prepared statement to handle single quotes
          $sql = "INSERT INTO foods (name, imageUrl, description, rating, price, prepTime, category, dietary, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $stmt = mysqli_prepare($connect, $sql);

          // Bind parameters
          mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $uploadPath, $description, $rating, $price, $prepTime, $category, $dietary, $featured);

          // Execute the statement
          mysqli_stmt_execute($stmt);

          header("Location: admin-profile.php");
          exit();
        } else {
          $error = "You cannot upload this file types.";
        }
      }
    } else {
      $error = "Oops! Something went wrong!";
    }
  }
}
?>
