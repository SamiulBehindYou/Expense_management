<?php session_start();
require 'db.php';

if (isset($_SESSION['login_status'])) {
  $user_id = $_SESSION['user_id'];
  $_SESSION['test'] = 0;

  // Prepare statement to count the user
  $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE id = ?");
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  $stmt->close();

  if ($count == 1) {
    // Prepare statement to select user data
    $stmt2 = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt2->bind_param("s", $user_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row = $result2->fetch_assoc();
    $stmt2->close();
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Meal Account</title>
  <style>
    body {
      overflow-x: hidden;
    }
  </style>
</head>
<body>
  <div class="card text-center">
    <div class="card-header bg-info">
      <ul class="nav nav-tabs card-header-tabs">
        <?php if (isset($_SESSION['login_status'])) { ?>
          <li class="nav-item">
            <a class="nav-link active rounded bg-info text-white border-3 border-white mr-1 mb-2"
              href="index.php"><?= (isset($row['name'])) ? $row['name'] : '' ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active rounded bg-info text-white border-3 border-white mr-1 mb-2"
              href="update_profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active rounded bg-danger text-white border-3 border-white mr-1 mb-2"
              href="logout.php">Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link active rounded bg-info text-white border-3 border-white mr-1 mb-2"
              href="login.php">Login</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>