<?php
include "utils/admin_session_check.php";
$sql = "SELECT * FROM foods ORDER BY foodID ASC";
$result = mysqli_query($connect, $sql);
include "utils/delete-food.php";
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
  <title>Admin Profile</title>
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
        <h3>MANAGE FOODS</h3>
        <a href="add-food.php">
          <button type="submit" class="btn btn-success mt-3">
            + ADD FOODS
          </button>
        </a>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <table class="table">
            <thead class="head-title">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Featured</th>
                <th scope="col">Dietary</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
              ?>
                  <tr>
                    <input type="hidden" name="foodID" value="<?php echo $data['foodID']; ?>">
                    <input type="hidden" name="imageUrl" value="<?php echo $data['imageUrl']; ?>">
                    <td><?php echo $data['name']; ?></td>
                    <td><img style="width: 13rem; height: 9rem;" src="<?php echo $data['imageUrl']; ?>" alt="foodImage"></td>
                    <td><?php echo $data['description']; ?></td>
                    <td><?php echo $data['featured'] ? 'true' : 'false'; ?></td>
                    <td><?php echo $data['dietary']; ?></td>
                    <td><?php echo $data['price']; ?> £</td>
                    <td>
                      <a href="update-food.php?id=<?php echo $data['foodID'] ?>">
                        <button type="button" class="btn btn-success">
                          UPDATE
                        </button>
                      </a>
                    </td>
                    <td>
                      <a href="utils/delete-food.php?id=<?php echo $data['foodID']; ?>">
                        <button type="button" class="btn btn-danger">
                          <i class="bi bi-trash"></i>
                        </button>
                      </a>
                  </tr>
              <?php }
              } else {
                echo "<h2>Empty record</h2>";
              } ?>
            </tbody>
          </table>
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