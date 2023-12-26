<?php
include "utils/config.php";

/// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-order-status'])) {
  // Get values from the form
  $orderID = $_POST['orderID'];
  $newStatus = $_POST['new-status'];
  $status = "";

  // Update the order status in the database
  $sql = "UPDATE food_order SET status = '$newStatus' WHERE orderID = $orderID";

  if (mysqli_query($connect, $sql)) {
    $status = "Order status updated successfully.";
  } else {
    echo "Error updating order status: " . mysqli_error($conn);
  }
}

// Fetch orders from the database, joining with the user table
$sql = "SELECT food_order.orderID, user.firstName, user.lastName, food_order.totalAmount, food_order.status, food_order.orderDate
      FROM food_order
      JOIN user ON food_order.userID = user.userID";
$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include './utils/resources.php' ?>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/user-profile.css">
  <link rel="stylesheet" href="./css/order.css">
  <title>Admin Profile</title>
</head>

<body class="body-container">
  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <section class="user-profile-container">
      <section class="user-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="admin-profile.php">MANAGE FOODS</a>
          </li>
          <li class="breadcrumb-item">
            <a href="admin-order.php"><u>MANAGE ORDERS</u></a>
          </li>
          <li class="breadcrumb-item"><a href="./utils/logout.php">LOGOUT</a></li>
        </ol>
      </section>
      <section class="first-column">
        <a href="user-profile.php">
          <a href="admin-profile.php">
            <h3 class="profile-menu">MANAGE FOODS</h3>
          </a>
          <a class="border" href="admin-order.php">
            <h3 class="profile-menu">MANAGE ORDERS</h3>
          </a>
          <a href="./utils/logout.php">
            <h3 class="profile-menu">LOGOUT</h3>
          </a>
      </section>
      <section class="second-column">
        <h3>ADMIN DASHBOARD</h3>
        <h3>MANAGE ORDERS</h3>
        <h4><?php echo isset($status) ? $status : null; ?></h4>
        <table class="table">
          <thead class="head-title">
            <tr>
              <th scope="col">OrderID</th>
              <th scope="col">Name</th>
              <th scope="col">Amount</th>
              <th scope="col">Status</th>
              <th scope="col">Ordered Date</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Iterate through each order
            while ($row = mysqli_fetch_assoc($result)) {
              $orderID = $row['orderID'];
              $userName = $row['firstName'] . ' ' . $row['lastName'];
              $totalAmount = $row['totalAmount'];
              $status = $row['status'];
              $orderedDate = $row['orderDate'];
            ?>
              <tr>
                <td><?php echo $orderID; ?></td>
                <td><?php echo $userName; ?></td>
                <td>£<?php echo $totalAmount; ?></td>
                <form action="" method="POST">
                  <td>
                    <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
                    <select class="form-select" name="new-status" aria-label="Default select example">
                      <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                      <option value="Processing" <?php echo ($status == 'Processing') ? 'selected' : ''; ?>>Processing</option>
                      <option value="Out for delivery" <?php echo ($status == 'Out for delivery') ? 'selected' : ''; ?>>Out for delivery</option>
                      <option value="Delivered" <?php echo ($status == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                      <option value="Cancelled" <?php echo ($status == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                  </td>
                  <td>
                    <?php echo $orderedDate; ?>
                  </td>
                  <td>
                    <button type="submit" class="btn btn-success" name="update-order-status">
                      UPDATE
                    </button>
                  </td>
                </form>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </section>
    </section>
  </section>
  <!-- END SECTION ONE -->
  </section>
  <!-- START FOOTER -->
  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->

</html>