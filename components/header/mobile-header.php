<nav class="mobile-header">
  <div class="mobile-nav-item">
    <a href="index.php">
      HOME
    </a>
  </div>
  <hr>
  <div class="mobile-nav-item">
    <a href="aboutus.php">
      ABOUT US
    </a>
  </div>
  <hr>
  <div class="mobile-nav-item">
    <a href=<?php echo $link; ?>><?php echo ($title) ? 'USER' : 'REGISTER'; ?>
    </a>
  </div>
  <?php
  if (isset($_SESSION['emailAddress']) && $_SESSION['emailAddress'] === 'admin') {
    echo null;
  } else {
    echo '<hr>
      <div class="mobile-nav-item">
        <a href="order.php">
        BASKET (' . $basketCount . ')
        </a>
      </div>';
  }
  ?>

</nav>