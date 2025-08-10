<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$name = $_SESSION['name'];
$room_type = $_SESSION['room_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard - UniNest</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: linear-gradient(to right, #e9f5ff, #f0f4f8);
      color: #333;
    }

    .dashboard-container {
      max-width: 700px;
      margin: 60px auto;
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      text-align: center;
    }

    h2 {
      color: #0077cc;
      margin-bottom: 10px;
    }

    p {
      font-size: 1.1rem;
      margin-bottom: 20px;
    }

    .dashboard-button {
      display: inline-block;
      background-color: #0A1D56;
      color: white;
      text-decoration: none;
      padding: 12px 20px;
      border-radius: 25px;
      margin: 10px;
      font-weight: bold;
      transition: 0.3s;
    }

    .dashboard-button:hover {
      background-color: #142c86;
    }
  </style>
</head>
<body>

  <div class="dashboard-container">
    <h2>🎓 Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
    <a href="index.html" class="dashboard-button">🏠 Go to Home</a>

    <?php if ($room_type === "poster") { ?>
      <p>This is your dashboard as a <strong>Room Owner</strong>.</p>
      <a href="room_post.html" class="dashboard-button">➕ Post a Room</a>
      <a href="my-posts.php" class="dashboard-button">📄 View My Posts</a>
    <?php } elseif ($room_type === "seeker") { ?>
      <p>This is your dashboard as a <strong>Room Seeker</strong>.</p>
      <a href="browse-room.php" class="dashboard-button">🔍 Browse Rooms</a>
      <a href="compatibility-test.html" class="dashboard-button">🧪 Compatibility Test</a>
    <?php } else { ?>
      <p>⚠️ Room type not set. Please contact admin.</p>
    <?php } ?>
  </div>

</body>
</html>
