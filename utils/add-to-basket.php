<?php 
if (isset($_POST['add_to_basket'])) {
  $foodID = $_POST['foodID'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $imageUrl = $_POST['imageUrl'];
  $price = $_POST['price'];

  // Initialize basket if not already done
  if (!isset($_SESSION['basket'])) {
      $_SESSION['basket'] = array();
  }

  // Add the selected item to the basket
  $_SESSION['basket'][] = array(
      'foodID' => $foodID,
      'name' => $name,
      'price' => $price,
      'description' => $description,
      'imageUrl' =>  $imageUrl,
  );
  // You can redirect the user back to the foods.php page or wherever you want
  header("Location: foods.php");
  exit();
}
?>