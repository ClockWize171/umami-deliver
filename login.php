<?php
include("utils/login_config.php");

// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["emailAddress"] !== "admin") {
  header("location: user-profile.php");
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
  <link rel="stylesheet" href="./css/register.css">
  <title>Login</title>
</head>

<body class="body-container">
  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <!-- START SECTION ONE -->
    <section class="register-section">
      <h2 class="register-title">SIGN IN</h2>
      <?php
      if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
      }
      ?>
      <form class="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="email">Email Address:</label>
        <input required class="register-input <?php echo (!empty($emailAddress_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailAddress; ?>" type="text" id="emailAddress" name="emailAddress" placeholder="Enter Email address...">
        <span class="invalid-feedback"><?php echo $emailAddress_err; ?></span>

        <label for="password">Password:</label>
        <input required class="register-input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" id="password" name="password" placeholder="Enter Password...">
        <span class="invalid-feedback"><?php echo $password_err; ?></span>

        <button type="submit" class="register-button">SIGN IN</button>
        <p class="register-login-text">
          Don't have account yet?
          <a href="register.php" class="register-login">SIGN UP</a> here!
        </p>
      </form>

    </section>
    <!-- END SECTION ONE -->
  </section>
  <!-- START FOOTER -->
  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->

</html>