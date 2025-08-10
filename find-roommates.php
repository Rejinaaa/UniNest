<?php
session_start();
include 'db.php';

// Fetch all room posts
$query = "SELECT * FROM rooms ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Find Roommates – UniNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      margin-top: 40px;
    }
    .room-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 30px;
    }
    .room-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      padding: 20px;
      transition: 0.3s ease;
    }
    .room-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    }
    .room-card h5 {
      color: #0b7285;
      margin-bottom: 10px;
    }
    .room-card p {
      margin-bottom: 8px;
    }
    .room-card .badge {
      margin-right: 5px;
    }
    .btn-contact {
      background-color: #0b7285;
      color: #fff;
      border: none;
      width: 100%;
    }
    .btn-contact:hover {
      background-color: #095a6d;
    }
    .posted {
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4 text-center">🏠 Roommate Listings at Kathmandu University</h2>

    <?php if ($result->num_rows > 0): ?>
      <div class="room-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="room-card">
            <h5><?= htmlspecialchars($row['location']) ?> — Rs.<?= htmlspecialchars($row['rent']) ?></h5>
            <p><?= htmlspecialchars($row['description']) ?></p>
            <div>
              <span class="badge bg-info text-dark">🧼 <?= $row['cleanliness'] ?></span>
              <span class="badge bg-secondary">🛌 <?= $row['sleep_schedule'] ?></span>
              <span class="badge bg-success">😄 <?= $row['personality'] ?></span>
              <span class="badge bg-warning text-dark">🚻 <?= $row['gender_preference'] ?></span>
            </div>
            <p class="posted mt-2">📅 Posted on: <?= htmlspecialchars($row['created_at']) ?></p>
            <button class="btn btn-contact mt-3">📨 Contact</button>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info text-center">No room posts yet. Be the first to post one! 🏡</div>
    <?php endif; ?>
  </div>
</body>
</html>
