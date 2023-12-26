<?php
include "utils/admin_session_check.php";
include "utils/update-food-controller.php";
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
  <title>Update Food</title>
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
            <a href="admin-profile.php"><u>MANAGE FOODS</u></a>
          </li>
          <li class="breadcrumb-item"><a href="admin-order.php">MANAGE ORDERS</a></>
          <li class="breadcrumb-item"><a href="./utils/logout.php">LOGOUT</a></li>
        </ol>
      </section>
      <section class="first-column">
        <a href="user-profile.php">
          <a class="border" href="admin-profile.php">
            <h3 class="profile-menu">MANAGE FOODS</h3>
          </a>
          <a href="admin-order.php">
            <h3 class="profile-menu">MANAGE ORDERS</h3>
          </a>
          <a href="./utils/logout.php">
            <h3 class="profile-menu">LOGOUT</h3>
          </a>
      </section>
      <section class="second-column">
        <h3>ADMIN DASHBOARD</h3>
        <h3>UPDATE FOOD</h3>
        <section class="container">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="col-md-5 mb-3">
              <img style="width: 13rem; height: 9rem;" src="<?php echo $imageUrl; ?>" alt="">
            </div>
            <input type="hidden" name="foodID" value="<?php echo $id; ?>">
            <div class="col-md-5 mb-3">
              <label for="exampleInputEmail1" class="form-label">Name:</label>
              <input required type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="col-md-5 mb-3">
              <label for="exampleInputEmail1" class="form-label">Description:</label>
              <textarea required class="form-control" id="floatingTextarea" name="description"><?php echo $description; ?></textarea>
            </div>
            </div>
            <div class="col-md-5 mb-3">
              <label for="exampleInputEmail1" class="form-label">Featured:</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" value="0" name="featured" id="flexSwitchCheckDefault" <?php echo $featured ? 'checked' : ''; ?>>
              </div>
            </div>
            <div class="col-md-5 mb-3">
              <label for="exampleInputEmail1" class="form-label">Dietary:</label>
              <select name="dietary" class="form-select" aria-label="Default select example">
                <option value="" <?php echo empty($dietary) ? 'selected' : ''; ?>> -Select Dietaries-</option>
                <option value="Vegan" <?php echo ($dietary === 'Vegan') ? 'selected' : ''; ?>>Vegan</option>
                <option value="Gluten Free" <?php echo ($dietary === 'Gluten Free') ? 'selected' : ''; ?>>Gluten Free</option>
                <option value="Halal" <?php echo ($dietary === 'Halal') ? 'selected' : ''; ?>>Halal</option>
              </select>
            </div>
            <div class="col-md-5 mb-3">
              <label for="exampleInputEmail1" class="form-label">Category:</label>
              <select class="form-select" name="category" aria-label="Default select example" required>
                <option value="" <?php echo empty($category) ? 'selected' : ''; ?>> -Select Category-</option>
                <option value="Asian" <?php echo ($category === 'Asian') ? 'selected' : ''; ?>>Asian</option>
                <option value="American" <?php echo ($category === 'American') ? 'selected' : ''; ?>>American</option>
                <option value="Italian" <?php echo ($category === 'Italian') ? 'selected' : ''; ?>>Italian</option>
                <option value="Indian" <?php echo ($category === 'Indian') ? 'selected' : ''; ?>>Indian</option>
              </select>
            </div>
            <div class="col-md-5 mb-3">
              <label for="exampleInputEmail1" class="form-label">Price:</label>
              <input required name="price" type="number" min="1" step="any" class="form-control" value="<?php echo $price; ?>">
            </div>
            <div class="col-md-5 mb-3">
              <label class="form-label">Rating:</label>
              <input required name="rating" type="number" min="1" max="5" step="1" class="form-control" value="<?php echo $rating; ?>">
            </div>
            <div class="col-md-5 mb-3">
              <label class="form-label">Prepartion Time:</label>
              <input required name="prepTime" type="number" min="1" step="1" class="form-control" value="<?php echo $prepTime; ?>">
            </div>
            <button type="submit" class="btn btn-success" name="update-food">UPDATE FOOD</button>
          </form>
        </section>
      </section>
    </section>



  </section>
  <!-- END SECTION ONE -->
  </section>
  <!-- START FOOTER -->
  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->

</html>