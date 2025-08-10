<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  echo "📩 Email: $email<br>";
  echo "🔑 Password: $password<br>";

  $stmt = $conn->prepare("SELECT user_id, name, password, role FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    echo "🧍 User found: " . $user["name"] . "<br>";
    echo "🔒 Hashed password in DB: " . $user["password"] . "<br>";

    if (password_verify($password, $user['password'])) {
      $_SESSION["user_id"] = $user["user_id"];
      $_SESSION["name"] = $user["name"];
      $_SESSION["role"] = $user["role"];
      echo "✅ Login successful. <a href='dashboard.php'>Go to dashboard</a>";
    } else {
      echo "❌ Password is incorrect.";
    }
  } else {
    echo "❌ Email not found.";
  }
}
?>