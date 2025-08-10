<?php
include 'db.php';

// Approve user if form submitted
if (isset($_POST['approve_id'])) {
    $id = $_POST['approve_id'];
    $sql = "UPDATE users SET verified = 1 WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch users who are not yet verified (approved)
$result = $conn->query("SELECT user_id, name, email, role, room_type FROM users WHERE verified = 0");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel - Approve Users</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
    th { background-color: #444; color: #fff; }
    button { padding: 6px 12px; background: #28a745; color: white; border: none; cursor: pointer; }
    button:hover { background: #218838; }
  </style>
</head>
<body>
  <h2>🛡️ Admin Dashboard – Approve Pending Users</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Room Type</th>
        <th>Action</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row["user_id"]) ?></td>
          <td><?= htmlspecialchars($row["name"]) ?></td>
          <td><?= htmlspecialchars($row["email"]) ?></td>
          <td><?= htmlspecialchars($row["role"]) ?></td>
          <td><?= htmlspecialchars($row["room_type"]) ?></td>
          <td>
            <form method="POST" style="margin:0;">
              <input type="hidden" name="approve_id" value="<?= htmlspecialchars($row["user_id"]) ?>">
              <button type="submit">✅ Approve</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>🎉 All users are approved!</p>
  <?php endif; ?>
</body>
</html>
