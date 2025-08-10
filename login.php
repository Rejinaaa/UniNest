<?php
session_start();
include 'db.php'; // Adjust path if needed

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($user = $result->fetch_assoc()) {
    if (!password_verify($password, $user["password"])) {
      $error = "❌ Incorrect password.";
    } else {
      $_SESSION["user_id"] = $user["user_id"];
      $_SESSION["name"] = $user["name"];
      $_SESSION["role"] = $user["role"];
      header("Location: dashboard.php"); // Redirect to your dashboard or home
      exit;
    }
  } else {
    $error = "❌ No user found with that email.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login – UniNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      <?php if (isset($_SESSION['signup_success'])): ?>
  <div class="alert alert-success text-center">
    <?php 
      echo $_SESSION['signup_success']; 
      unset($_SESSION['signup_success']); 
    ?>
  </div>
<?php endif; ?>

      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(-45deg, #6a11cb, #2575fc, #1fd1f9, #c33764);
      background-size: 400% 400%;
      animation: gradient 15s ease infinite;
    }

    @keyframes gradient {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .login-box {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      backdrop-filter: blur(10px);
      color: #fff;
      width: 100%;
      max-width: 360px;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: 600;
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.15);
      color: #fff;
      border: none;
    }

    .form-control::placeholder {
      color: #ddd;
    }

    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(0, 198, 255, 0.25);
    }

    .btn-login {
      background-color: #00c6ff;
      border: none;
      font-weight: bold;
    }

    .btn-login:hover {
      background-color: #005bea;
    }

    .error {
      color: #ffdddd;
      font-size: 14px;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>🔐 Login to UniNest</h2>
    <form method="POST" action="login.php" novalidate>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="KU Email (@ku.edu.np)" required pattern=".+@ku\.edu\.np" title="Only KU emails allowed">
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-login w-100">Log In</button>

      <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
      <?php endif; ?>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
