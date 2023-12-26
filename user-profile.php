<?php
include 'utils/session_check.php';
include 'utils/update-profile.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include './utils/resources.php' ?>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/user-profile.css">
  <title>Your Profile</title>
</head>

<body class="body-container">
  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <section class="user-profile-container">
      <section class="user-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="user-profile.php"><u>ACCOUNT DETAIL</u></a></li>
          <li class="breadcrumb-item"><a href="order.php">YOUR ORDERS</a></li>
          <li class="breadcrumb-item"><a href="basket.php">YOUR BASKET</a></li>
          <li class="breadcrumb-item"><a href="./utils/logout.php">LOGOUT</a></li>
        </ol>
      </section>
      <section class="first-column">
        <a class="border" href="user-profile.php">
          <h3 class="profile-menu">ACCOUNT DETAIL</h3>
        </a>
        <a href="basket.php">
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
        <h3>ACCOUNT DETAIL</h3>
        <form class="user-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="row mt-3">
            <div class="col-md-6">
              <label class="form-label">First Name: </label>
              <input required value="<?php echo $firstName; ?>" type="text" class="form-control" name="updatedFirstName" aria-describedby="emailHelp" />

            </div>
            <div class="col-md-6">
              <label class="form-label">Last Name:</label>
              <input required value="<?php echo $lastName; ?>" type="text" class="form-control" name="updatedLastName" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <label class="form-label">Email address</label>
              <input required value="<?php echo $emailAddress; ?>" disabled type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="col-md-6">
              <label class="form-label">Address:</label>
              <input value="<?php echo $address; ?>" type="text" class="form-control" name="updatedAddress" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <label class="form-label">Postcode:</label>
              <input required value="<?php echo $postcode; ?>" type="text" class="form-control" name="updatedPostcode" aria-describedby="emailHelp">
            </div>
            <div class="col-md-6">
              <label class="form-label">Credit Card Number:</label>
              <input required type="text"  maxlength="19" class="form-control" pattern="\d*" value="<?php echo $creditCardInfo; ?>" name="updatedCreditCardInfo" title="Please enter only numbers" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
            </div>
          </div>
          <button type="submit" class="btn btn-success mt-3 account-detail-button">
            UPDATE
          </button>

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