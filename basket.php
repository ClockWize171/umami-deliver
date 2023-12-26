<?php
include "utils/order-controller.php";
// Handle delete action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-basket'])) {
  $deleteIndex = $_POST['delete-index'];

  // Check if the basket is set in the session
  if (isset($_SESSION['basket'])) {
    $basket = $_SESSION['basket'];

    // Remove the item from the basket based on the index
    if (isset($basket[$deleteIndex])) {
      unset($basket[$deleteIndex]);

      // Update the session basket
      $_SESSION['basket'] = array_values($basket);
    }
  }

  header('Location: basket.php');
  exit;
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
  <title>Your Basket</title>
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
          <li class="breadcrumb-item"><a href="order.php">YOUR ORDERS</a></li>
          <li class="breadcrumb-item"><a href="basket.php"><u>YOUR BASKET</u></a></li>
          <li class="breadcrumb-item"><a href="./utils/logout.php">LOGOUT</a></li>
        </ol>
      </section>
      <section class="first-column">
        <a href="user-profile.php">
          <h3 class="profile-menu">ACCOUNT DETAIL</h3>
        </a>
        <a class="border" href="basket.php">
          <h3 class="profile-menu">BASKET(0)</h3>
        </a>
        <a href="order.php">
          <h3 class="profile-menu">YOUR ORDERS</h3>
        </a>
        <a href="./utils/logout.php">
          <h3 class="profile-menu">LOGOUT</h3>
        </a>
      </section>
      <section class="second-column">
        <h3>YOUR BASKET</h3>
        <table class="table">
          <thead class="head-title">
            <tr>
              <th scope="col"></th>
              <th scope="col">Orders</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Check if the basket is set in the session
            if (isset($_SESSION['basket'])) {
              $basket = $_SESSION['basket'];

              $subtotal = 0;
              $deliveryFee = 2; // This will be constant

              // Iterate through each item in the basket
              foreach ($basket as $index => $item) {
                $id = $item['foodID'];
                $foodName = $item['name'];
                $foodDescription = $item['description'];
                $imgUrl = $item['imageUrl'];
                $price = $item['price'];

                // Update subtotal
                $subtotal += $price;
            ?>
                <tr>
                  <td style="vertical-align: middle;">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                      <input type="hidden" name="delete-index" value="<?php echo $index; ?>">
                      <button type="submit" class="btn btn-danger" name="delete-basket">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                  <td>
                    <div class="order-data">
                      <img src="<?php echo $imgUrl; ?>" alt="image">
                      <div>
                        <p><b><?php echo $foodName; ?></b></p>
                        <p><?php echo $foodDescription; ?></p>
                      </div>
                    </div>
                  </td>
                  <td><?php echo $price; ?> £</td>
                </tr>
                </tr>
              <?php
              }
              ?>
              <tr>
                <th></th>
                <th>Subtotal: </th>
                <td><?php echo $subtotal; ?> £</td>
              </tr>
              <tr>
                <th></th>
                <th>Delivery Fee: </th>
                <td>2£</td>
              </tr>
              <tr>
                <th></th>
                <th>Total: </th>
                <td><?php echo $subtotal + $deliveryFee; ?> £</td>
              </tr>
            <?php
            } else {
              echo "empty basket!";
            }
            ?>
          </tbody>
        </table>
        <form action="./utils/order-controller.php" method="POST">
          <div class="payment-section">
            <h4 class="payment-title">SELECT A PAYMENT METHODS:</h4>
            <select class="form-select" name="paymentMethod" aria-label="Default select example">
              <option selected value="PayWithCard">Pay with card</option>
              <option value="CashOnDelivery">Cash On Delivery</option>
            </select>
            <button type="submit" class="btn btn-success <?php echo empty($_SESSION['basket']) ? 'disabled' : ''; ?> account-detail-button" name="place-order">
              ORDER NOW
            </button>
          </div>
        </form>
      </section>
    </section>



  </section>
  <!-- END SECTION ONE -->
  </section>
  <!-- START FOOTER -->
  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->

</html>