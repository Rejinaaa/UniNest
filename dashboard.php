<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UniNest Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      display: flex;
      height: 100vh;
      background-color: #f5f7fa;
    }
    .sidebar {
      width: 250px;
      background: #0b7285;
      color: white;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }
    .sidebar h2 {
      margin-bottom: 30px;
      font-size: 24px;
    }
    .nav-link {
      margin: 15px 0;
      color: white;
      text-decoration: none;
      display: flex;
      align-items: center;
      font-size: 16px;
    }
    .nav-link:hover {
      background: #095061;
      padding: 10px;
      border-radius: 8px;
    }
    .main-content {
      flex: 1;
      padding: 40px;
    }
    .welcome {
      margin-bottom: 30px;
      font-size: 22px;
      font-weight: 600;
    }
    .welcome span {
      color: #0b7285;
    }
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 30px;
    }
    .card {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      text-align: center;
    }
    .card h3 {
      font-size: 20px;
      margin-bottom: 10px;
      color: #0b7285;
    }
    .card p {
      color: #333;
      margin-bottom: 20px;
    }
    .card button {
      background: none;
      border: 2px solid #0b7285;
      color: #0b7285;
      padding: 8px 16px;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
    }
    .card button:hover {
      background: #0b7285;
      color: white;
    }
    .logout {
      margin-top: auto;
      padding-top: 30px;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>UniNest</h2>
    <a class="nav-link" href="#">🏠 Dashboard</a>
    <a class="nav-link" href="#">🔍 Find Roommates</a>
    <a class="nav-link" href="#">📁 My Posts</a>
    <a class="nav-link" href="#">📝 Post a Room</a>
    <div class="logout">
      <a class="nav-link" href="logout.php">🚪 Logout</a>
    </div>
  </div>

  <div class="main-content">
    <div class="welcome">👋 Welcome to UniNest — find your perfect roommate match at <em>Kathmandu University</em>.</div>

    <div class="card-grid">
      <div class="card">
        <h3>Find Roommates</h3>
        <p>Search for compatible roommate matches</p>
       <button onclick="location.href='find-roommates.php'">Search</button>

      </div>
      <div class="card">
        <h3>My Posts</h3>
        <p>View and manage your existing room listings</p>
        <button onclick="location.href='my-posts.php'">View</button>
      </div>
      <div class="card">
        <h3>Post a Room</h3>
        <p>Create a new room listing for others to find</p>
        <button onclick="location.href='post-room.html'">Create</button>
      </div>
    </div>
  </div>
</body>
</html>
