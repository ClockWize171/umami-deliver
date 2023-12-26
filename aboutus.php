<?php include "utils/config.php"?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  include './utils/resources.php'
  ?>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/aboutus.css">
  <title>About Us</title>
</head>

<body class="body-container">

  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <!-- START SECTION ONE -->
    <section class="about-section">
      <section class="about-section-one"></section>
      <section class="about-section-two">
        <img class="about-section-two-image" src="./images/about-image1.jpg" alt="img1">
        <div class="about-section-two-info">
          <h2 class="about-section-two-title">ABOUT US</h2>
          <p class="about-section-two-text">
            At Umami-Deliver, we're passionate about delivering more than just meals, we deliver experiences that bring joy and convenience to your dining table. With a deep love for food and a commitment to customer satisfaction, we've embarked on a mission to redefine the way you enjoy your favorite flavors.
          </p>
        </div>
      </section>
    </section>
    <!-- END SECTION ONE -->
  </section>
  <!-- START FOOTER -->
  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->

</body>

</html>