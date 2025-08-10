<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  die("You must be logged in.");
}

$user_id = $_SESSION['user_id'];

$me = $conn->prepare("SELECT * FROM compatibility WHERE user_id = ?");
$me->bind_param("i", $user_id);
$me->execute();
$result = $me->get_result();

if ($result->num_rows === 0) {
  echo "❗You haven't completed the compatibility quiz yet. <a href='compatibility.html'>Take it now</a>";
  exit;
}

$my_data = $result->fetch_assoc();

$stmt = $conn->prepare("SELECT u.name, u.email FROM users u
JOIN compatibility c ON u.user_id = c.user_id
WHERE u.user_id != ? AND
c.sleep_schedule = ? AND
c.cleanliness = ? AND
c.social_preference = ? AND
c.noise_tolerance = ? AND
c.study_habits = ?");

$stmt->bind_param("isssss", $user_id, $my_data['sleep_schedule'], $my_data['cleanliness'], $my_data['social_preference'], $my_data['noise_tolerance'], $my_data['study_habits']);
$stmt->execute();
$matches = $stmt->get_result();

echo "<h2>🎯 Matching Users:</h2>";
if ($matches->num_rows > 0) {
  while ($row = $matches->fetch_assoc()) {
    echo "<p>Name: {$row['name']} | Email: {$row['email']}</p>";
  }
} else {
  echo "⚠️ No perfect matches yet.";
}
?>
