<?php
include "utils/foods-controller.php";
include "utils/add-to-basket.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include './utils/resources.php' ?>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/foods.css">
  <title>Foods</title>
</head>

<body class="body-container">
  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <!-- SEARCH BAR -->
    <section class="container-fluid search-bar">
      <form action="">
        <div class="form-group has-search">
          <span class="fa fa-search form-control-feedback"></span>
          <input type="text" class="form-control search-input" placeholder="Search your food here..." name="search">
        </div>
      </form>
    </section>

    <!-- EXPLORE BY CATEGORY -->
    <section class="container-fluid category">
      <h3>EXPLORE BY CATEGORIES</h3>
      <div class="container-fluid category-cards">
        <a href="?search=Asian">
          <div class="category-card card1">Asian</div>
        </a>
        <a href="?search=American">
          <div class="category-card card2">American</div>
        </a>
        <a href="?search=Italian">
          <div class="category-card card3">Italian</div>
        </a>
        <a href="?search=Indian">
          <div class="category-card card4">Indian</div>
        </a>
      </div>
    </section>

    <!-- FOOD SECTION -->
    <section class="container-fluid foods">
      <h3>FOODS</h3>
      <form action="" method="GET">
        <section class="food-filters">
          <select class="form-select food-filter" aria-label="Default select example" name="sort">
            <option value="1" <?php echo isset($_GET['sort']) && $_GET['sort'] == '1' ? 'selected' : ''; ?>>Price</option>
            <option value="2" <?php echo isset($_GET['sort']) && $_GET['sort'] == '2' ? 'selected' : ''; ?>>Rating</option>
            <option value="3" <?php echo isset($_GET['sort']) && $_GET['sort'] == '3' ? 'selected' : ''; ?>>Name</option>
          </select>
          <button type="submit" class="btn btn-outline-success filter-button">APPLY FILTER</button>
        </section>
      </form>

      <!-- FOOD SECTION -->
      <section class="container mt-3 food-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="cards">
             
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="hidden" name="foodID" value="<?php echo $row['foodID']; ?>">
                <input type="hidden" name="description" value="<?php echo $row['description']; ?>">
                <input type="hidden" name="imageUrl" value="<?php echo $row['imageUrl']; ?>">
                <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                <img class="card-image" src="<?php echo $row['imageUrl']; ?>" alt="food1">
                <div class="card-info">
                  <h2 class="card-info-title"><?php echo $row['name']; ?></h2>
                  <div class="card-info-stars">
                    <?php
                    $rating = $row["rating"];
                    for ($i = 1; $i <= $rating; $i++) {
                      echo '<img class="star" src="./images/icons/star.svg" alt="star">';
                    }
                    ?>
                  </div>
                  <p>
                    <?php echo $row['description']; ?>
                  </p>
                  <i class="card-info-category">
                    <?php echo $row['category']; ?><?php echo $row['dietary'] ? ' - ' . $row['dietary'] : ''; ?>
                  </i>
                  <p class="card-info-time">
                    <span><i class="bi bi-clock"></i></span>
                    <?php echo $row['prepTime']; ?> mins
                  </p>
                </div>
                <button class="add-to-basket" name="add_to_basket"> + <?php echo $row['price']; ?> £
                </button>
              </form>
            </div>
        <?php
          }
        } else {
          echo "0 results";
        }
        ?>
      </section>

    </section>

  </section>
  <!-- END SECTION ONE -->
  </section>
  <!-- START FOOTER -->
  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->

</html>