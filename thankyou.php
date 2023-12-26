<?php include "utils/config.php"?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include './utils/resources.php' ?>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/thankyou.css">
  <title>Thank You for Your Order!</title>
</head>

<body class="body-container">
  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <section class="thankyou-container">
      <h2>THANK YOU!</h2>
      <h3>YOUR ORDER IS IN KITCHEN NOW!</h3>
      <img class="thankyou-img" src="images/thankyou.png" alt="thankyou">
      <a href="order.php">
        <button type="button" class="btn btn-outline-success thankyou-button">CHECK ORDER</button>
      </a>
    </section>
  </section>
  <!-- END SECTION ONE -->
  </section>
  <!-- START FOOTER -->
  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->

</html>