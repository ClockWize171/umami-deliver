<?php
include('utils/session_check.php');
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWD = '';
$DB_NAME = 'umami_deliver';

$connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);

if (mysqli_connect_errno()) {
  exit('Error connect to database' . mysqli_connect_error());
}
// Fetch user ID from the session
$userID = $_SESSION['userID'];

// Fetch user orders from the database
$sql = "SELECT * FROM food_order WHERE userID = $userID";
$result = mysqli_query($connect, $sql);

function getStatusBadgeClass($status)
{
  switch ($status) {
    case 'Pending':
      return 'bg-warning';
    case 'Processing':
      return 'bg-info';
    case 'Out for delivery':
      return 'bg-primary';
    case 'Delivered':
      return 'bg-success';
    case 'Cancelled':
      return 'bg-danger';
    default:
      return 'bg-secondary'; // Default class for unknown status
  }
}
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
  <title>Your Order</title>
</head>

<body class="body-container">
  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <section class="user-profile-container">
      <section class="user-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="user-profile.php">ACCOUNT DETAIL</a></li>
          <li class="breadcrumb-item"><a href="order.php"><u>YOUR ORDERS</u></a></li>
          <li class="breadcrumb-item"><a href="basket.php">YOUR BAKSET</a></li>
          <li class="breadcrumb-item"><a href="./utils/logout.php">LOGOUT</a></li>
        </ol>
      </section>
      <section class="first-column">
        <a href="user-profile.php">
          <h3 class="profile-menu">ACCOUNT DETAIL</h3>
        </a>
        <a href="basket.php">
          <h3 class="profile-menu">BASKET(0)</h3>
        </a>
        <a class="border" href="order.php">
          <h3 class="profile-menu">YOUR ORDERS</h3>
        </a>
        <a href="./utils/logout.php">
          <h3 class="profile-menu">LOGOUT</h3>
        </a>
      </section>
      <section class="second-column">
        <h3>YOUR ORDERS</h3>
        <table class="table">
          <thead class="head-title">
            <tr>
              <th scope="col"></th>
              <th scope="col">Order ID</th>
              <th scope="col">Total Price</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Check if there are orders
            if (mysqli_num_rows($result) > 0) {
              // Iterate through each order
              while ($row = mysqli_fetch_assoc($result)) {
                $orderID = $row['orderID'];
                $totalAmount = $row['totalAmount'];
                $status = $row['status'];
            ?>
                <tr>
                  <td style="vertical-align: middle;">
                  </td>
                  <td>
                    <div class="order-data">
                      <div>
                        <p><b><?php echo $orderID; ?></b></p>
                      </div>
                    </div>
                  </td>
                  <td> £<?php echo $totalAmount; ?> </td>
                  <td>
                    <h5><span class="badge <?php echo getStatusBadgeClass($status); ?>"><?php echo $status; ?></span></h5>
                  </td>

                </tr>
                </tr>
            <?php
              }
            } else {
              // If there are no orders, you can display a message or handle it accordingly
              echo "No orders found.";
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