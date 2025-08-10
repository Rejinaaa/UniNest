<?php
// signup.php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $role = $_POST["role"];
  $room_type = $_POST["room_type"];

  // Ensure KU email
  if (!str_ends_with($email, "@ku.edu.np")) {
    echo "<div style='color: red; text-align:center;'>❌ Only KU emails are allowed.</div>";
    exit;
  }

  // Check if email already exists
  $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    echo "<div style='color: red; text-align:center;'>❌ Email already registered. Try logging in.</div>";
    exit;
  }

  // Proceed to insert
 // Proceed to insert
$verified = 1;
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role, room_type, verified) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $name, $email, $password, $role, $room_type, $verified);

// 🚀 THIS was missing!
if ($stmt->execute()) {
  session_start();
  $_SESSION['signup_success'] = "✅ Signup successful! Please log in.";
  header("Location: login.php");
  exit;
} else {
  echo "<div style='color:red;text-align:center;'>❌ Signup failed: " . $stmt->error . "</div>";
  exit;
}


  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Signup – UniNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .signup-container {
      max-width: 420px;
      margin: 5vh auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .form-control, .form-select {
      border-radius: 8px;
    }
    .btn-primary {
      background-color: #0d6efd;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0b5ed7;
    }
    .note {
      font-size: 12px;
      color: #6c757d;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="signup-container">
      <h2 class="text-center mb-4">📝 Create Your UniNest Account</h2>
      <form action="signup.php" method="POST">
        <div class="mb-3">
          <input type="text" name="name" class="form-control" placeholder="Your Full Name" required>
        </div>
        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Your KU Email (@ku.edu.np)" required pattern=".+@ku\.edu\.np" title="Please use a KU email">
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Create Password" required>
        </div>
        <div class="mb-3">
          <select name="role" class="form-select" required>
            <option value="">Select Role</option>
            <option value="student">Student</option>
          </select>
        </div>
        <div class="mb-3">
          <select name="room_type" class="form-select" required>
            <option value="">Looking for / Posting Room?</option>
            <option value="poster">I have a room (Poster)</option>
            <option value="seeker">I need a room (Seeker)</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        <div class="note mt-3">* Only KU emails (@ku.edu.np) are allowed</div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
