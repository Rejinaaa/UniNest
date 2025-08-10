<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  echo "⚠️ You must be logged in to post a room.";
  exit;
}

// Get form data
$title = $_POST['room_title'];
$location = $_POST['location'];
$rent = $_POST['rent'];
$user_id = $_SESSION['user_id'];

// Handle image upload
$target_dir = "uploads/";
$image_name = basename($_FILES["room_image"]["name"]);
$target_file = $target_dir . time() . "_" . $image_name; // Unique filename

if (move_uploaded_file($_FILES["room_image"]["tmp_name"], $target_file)) {
  // Save post to database
  $stmt = $conn->prepare("INSERT INTO rooms (user_id, title, location, rent, image_path) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("issss", $user_id, $title, $location, $rent, $target_file);

  if ($stmt->execute()) {
    echo "✅ Room posted successfully!";
  } else {
    echo "❌ Failed to save room info.";
  }
} else {
  echo "❌ Failed to upload image.";
}
?>
