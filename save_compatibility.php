<?php
session_start();
include 'db.php';

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Handle only POST requests
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $user_id = $_SESSION['user_id'];
  $sleep = $_POST['sleep_schedule'];
  $clean = $_POST['cleanliness'];
  $social = $_POST['social_preference'];
  $noise = $_POST['noise_tolerance'];
  $study = $_POST['study_habits'];

  // Check if user has already submitted the quiz
  $check = $conn->prepare("SELECT * FROM compatibility WHERE user_id = ?");
  $check->bind_param("i", $user_id);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    // Update existing entry
    $stmt = $conn->prepare("UPDATE compatibility SET sleep_schedule=?, cleanliness=?, social_preference=?, noise_tolerance=?, study_habits=? WHERE user_id=?");
    $stmt->bind_param("sssssi", $sleep, $clean, $social, $noise, $study, $user_id);
  } else {
    // Insert new entry
    $stmt = $conn->prepare("INSERT INTO compatibility (user_id, sleep_schedule, cleanliness, social_preference, noise_tolerance, study_habits) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $sleep, $clean, $social, $noise, $study);
  }

  if ($stmt->execute()) {
    header("Location: match.php"); // Redirect after success
    exit;
  } else {
    echo "❌ Failed to save compatibility data: " . $stmt->error;
  }
} else {
  // If accessed without POST
  http_response_code(405);
  echo "❌ This page only accepts POST requests.";
}
