<?php
include "session_check.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place-order'])) {
  // Assuming you have a database connection
  $DB_HOST = 'localhost';
  $DB_USER = 'root';
  $DB_PASSWD = '';
  $DB_NAME = 'umami_deliver';

  $connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);

  if (mysqli_connect_errno()) {
    exit('Error connect to database' . mysqli_connect_error());
  }
  // Retrieve user ID from the session
  $userID = $_SESSION['userID'];

  // Retrieve order details from the basket
  $basket = $_SESSION['basket'];
  $subtotal = 0;
  $deliveryFee = 2; // Assuming a constant delivery fee

  // Calculate subtotal and total
  foreach ($basket as $item) {
    $subtotal += $item['price'];
  }

  $total = $subtotal + $deliveryFee;

  // Insert order into the database
  $paymentMethod = $_POST['paymentMethod'];
  $status = 'Pending'; // Set the initial status
  $insertOrderSQL = "INSERT INTO food_order (userID, totalAmount, paymentMethod, status) 
                       VALUES ('$userID', '$total', '$paymentMethod', '$status')";
  $result = mysqli_query($connect, $insertOrderSQL);

  if ($result) {
    // Retrieve the OrderID of the newly inserted order
    $orderID = mysqli_insert_id($connect);

    // Insert order items into food_orderitem table
    foreach ($basket as $item) {
      $foodID = $item['foodID'];
      $insertOrderItemSQL = "INSERT INTO food_orderitem (orderID, foodID) 
                                   VALUES ('$orderID', '$foodID')";
      mysqli_query($connect, $insertOrderItemSQL);
    }

    // Clear the basket as the order has been placed
    unset($_SESSION['basket']);

    // Redirect to confirmation page or display a confirmation message
    header('Location: ../thankyou.php');
    exit();
  } else {
    // Handle the case where insertion into food_order table fails
    echo "Failed to place the order.";
  }
}
?>