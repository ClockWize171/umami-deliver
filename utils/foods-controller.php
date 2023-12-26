<?php
include "config.php";
// Check if a search query is submitted
if (isset($_GET['search'])) {
  $searchQuery = $_GET['search'];
  $sql = "SELECT foodID, name, imageUrl, description, rating, price, prepTime, category, dietary FROM foods WHERE 
          name LIKE '%$searchQuery%' OR
          description LIKE '%$searchQuery%' OR
          category LIKE '%$searchQuery%' OR
          dietary LIKE '%$searchQuery%'";
} else {
  // If no search query, retrieve all foods
  $sql = "SELECT * FROM foods";
}

// Sorting
$sortColumn = 'name'; // Default sorting column
$sortOrder = 'ASC';   // Default sorting order

// Check sorting option
if (isset($_GET['sort'])) {
  $sortOption = $_GET['sort'];
  switch ($sortOption) {
    case '1':
      $sortColumn = 'price';
      break;
    case '2':
      $sortColumn = 'rating';
      $sortOrder = 'DESC'; // Set sorting order to DESC for rating
      break;
    case '3':
      $sortColumn = 'name';
      break;
  }
}

$sql .= " ORDER BY $sortColumn $sortOrder";

$result = mysqli_query($connect, $sql);
