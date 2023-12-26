<?php
include("utils/register-config.php");
// Check if the user is logged in, if login return to user-profile.php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
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
  <title>Register</title>
</head>

<body class="body-container">
  <!-- START NAVIGATION -->
  <?php include 'components/header/header.php' ?>
  <!-- END NAVIGATION -->

  <section class="main">
    <!-- START SECTION ONE -->
    <section class="register-section">
      <h2 class="register-title">SIGN UP</h2>
      <form class="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <label for="email">Email Address:</label>
        <input required class="register-input <?php echo (!empty($emailAddress_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailAddress; ?>" type="email" id="emailAddress" name="emailAddress" placeholder="Enter Email address...">
        <span class="invalid-feedback"><?php echo $emailAddress_err; ?></span>
        <label for="email">First Name:</label>
        <input required class="register-input" type="text" id="firstName" name="firstName" placeholder="Enter First Name...">

        <label for="email">Last Name:</label>
        <input required class="register-input" type="text" id="lastName" name="lastName" placeholder="Enter Last Name...">

        <label for="email">Address:</label>
        <input required class="register-input" type="text" id="address" name="address" placeholder="Enter Address...">

        <label for="email">Postcode:</label>
        <input required class="register-input" type="text" id="postcode" name="postcode" placeholder="Enter Postcode...">

        <label for="email">Phone Number:</label>
        <input required class="register-input" type="text" id="phoneNo" name="phoneNo" placeholder="Enter Postcode...">

        <label for="password">Password:</label>
        <input required class="register-input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" id="password" name="password" value="<?php echo $password; ?>" placeholder="Enter Password...">
        <span class="invalid-feedback"><?php echo $password_err; ?></span>

        <label for="confirm_password">Confirm Password:</label>
        <input class="register-input <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" type="password" id="password" value="<?php echo $confirm_password; ?>" name="confirm_password" placeholder="Enter Password Again...">
        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>

        <button type="submit" class="register-button">REGISTER</button>
        <p class="register-login-text">
          Already have an account?
          <a href="login.php" class="register-login">LOGIN</a> here!
        </p>
      </form>

    </section>
    <!-- END SECTION ONE -->
  </section>
  <!-- START FOOTER -->
  <?php include 'components/footer/footer.php' ?>
  <!-- END FOOTER -->

</html>