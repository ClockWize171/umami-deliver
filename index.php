<?php
include "utils/config.php";
$sql = "SELECT name, imageUrl, description, rating, price, prepTime, category, dietary, featured FROM foods";
$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  include './utils/resources.php'
  ?>
  <!-- CSS HERE -->
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/home-section-one.css">
  <link rel="stylesheet" href="./css/home-section-two.css">
  <link rel="stylesheet" href="./css/home-section-three.css">
  <title>Home Page</title>
</head>

<body class="body-container">
  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <!-- START SECTION ONE -->
    <section class="home-section-one">
      <div class="home-section-one-first-column">
        <img class="home-section-one-image" src="./images/home-section-one.png" alt="section one image">
      </div>
      <div class="home-section-second-first-column">
        <h2 class="title">
          Welcome to <span class="gradient-title">Umami-Deliver!</span>
        </h2>
        <p class="intro-text">Hungry?</p>
        <p class="intro-text">Don't worry, we've got you covered.</p>
        <p class="intro-text">Explore our mouthwatering menu.</p>
        <a href="foods.php">
          <button class="explore-now">
            EXPLORE NOW
            <img class="right-next-icon" src="./images/icons/right-next-icon.svg" alt="next icon">
          </button>
        </a>
      </div>
    </section>
    <!-- END SECTION ONE -->

    <!-- START SECTION TWO -->
    <section class="home-section-two">
      <img class="curve" src="./images/upper-curve.svg" alt="upper-curve">
      <div class="mid-section-two">
        <h2 class="home-section-two-title">POPULAR CUISINES</h2>
        <div class="popular-cuisine">
          <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              if ($row['featured']) {
          ?>
                <div class="cards">
                  <img class="card-image" src="<?php echo $row['imageUrl']; ?>" alt="food1">
                  <div class="card-info">
                    <h2 class="card-info-title">
                      <?php echo $row['name']; ?>
                    </h2>
                    <p class="card-info-category">
                      <?php echo $row['description']; ?>
                    </p>
                    <div class="card-info-stars">
                      <?php
                      $rating = $row["rating"];
                      for ($i = 1; $i <= $rating; $i++) {
                        echo '<img class="star" src="./images/icons/star-outline.svg" alt="star">';
                      }
                      ?>
                    </div>
                    <i class="card-info-category">
                      <?php echo $row['category']; ?><?php echo $row['dietary'] ? ' - ' . $row['dietary'] : ''; ?>
                    </i>
                    <p class="card-info-time">
                      <span>
                        <img class="card-icon" src="./images/icons/clock.svg" alt="clock"> </span><?php echo $row['prepTime']; ?> mins
                    </p>
                  </div>
                  <button class="add-to-basket">+ <?php echo $row['price']; ?> £
                </div>
          <?php
              }
            }
          } else {
            echo "0 results";
          }
          ?>

        </div>
      </div>
      <img class="curve" src="./images/lower-curve.svg" alt="lower-curve">
    </section>
    <!-- END SECTION TWO -->

    <!-- START SECTION THREE -->
    <section class="home-section-three">
      <div class="home-section-three-first-column">
        <h2 class="home-section-three-title">SPECIAL OFFERS</h2>
        <p class="home-section-three-p">
          Enjoy a 10% discount on your delicious meal with us. Use code
          "UMAMI10" at checkout.
        </p>
        <button class="home-section-three-button">CHECK OFFERS</button>
      </div>
      <div class="home-section-three-second-column">
        <img class="home-section-three-image" src="./images/floating-burger.png" alt="floating burger">
      </div>
    </section>
    <!-- END SECTION THREE -->
  </section>
  <!-- START FOOTER -->

  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->
</body>

</html>