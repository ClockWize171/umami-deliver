<?php
// Check if the basket session variable is set
$basketCount = isset($_SESSION['basket']) ? count($_SESSION['basket']) : 0;

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  $title = true;
  $link = "user-profile.php";
} else {
  $title = false;
  $link = "register.php";
}
?>

<nav class="desktop-navbar">
  <a href="index.php" class="logo">
    <img src="./images/logo.png" alt="umami-deliver logo">
  </a>
  <ul class="nav-links">
    <li class="nav-item"><a href="index.php">HOME</a></li>
    <li class="nav-item"><a href="aboutus.php">ABOUT US</a></li>
    <li class="nav-item">
      <a class="login" href=<?php echo $link; ?>><?php echo ($title) ? 'USER' : 'REGISTER'; ?></a>
    </li>
    <?php
    if (isset($_SESSION['emailAddress']) && $_SESSION['emailAddress'] === 'admin') {
      echo null;
    } else {
      echo '<li class="nav-item basket-item">
      <a class="login" href="basket.php">
        BASKET (' . $basketCount . ')
      </a>
    </li>';
    }
    ?>
  </ul>
  <?php include 'mobile-header.php' ?>
</nav>