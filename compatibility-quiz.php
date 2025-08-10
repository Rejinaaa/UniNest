<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  echo "❌ You are not logged in. Please <a href='login.php'>log in</a> first.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Compatibility Quiz – UniNest</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
    }

    .quiz-container {
      background: rgba(0, 0, 0, 0.6);
      padding: 40px;
      border-radius: 15px;
      max-width: 800px;
      margin: 50px auto;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #00ffd0;
    }

    .question {
      margin-bottom: 25px;
    }

    .form-check-label {
      margin-left: 10px;
    }

    .btn-submit {
      display: block;
      margin: 30px auto 0;
      background-color: #00c6ff;
      border: none;
      padding: 10px 30px;
      border-radius: 8px;
      color: white;
      font-weight: bold;
    }

    .btn-submit:hover {
      background-color: #005bea;
    }
  </style>
</head>
<body>

  <div class="quiz-container">
    <h2>🧠 Compatibility Quiz</h2>
    <form action="save_compatibility.php" method="POST">

      <!-- Sleep Patterns -->
      <div class="question">
        <label class="form-label">🛏️ What’s your sleep schedule?</label><br>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sleep_schedule" value="early bird" required>
          <label class="form-check-label">Early bird</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sleep_schedule" value="night owl" required>
          <label class="form-check-label">Night owl</label>
        </div>
      </div>

      <!-- Cleanliness -->
      <div class="question">
        <label class="form-label">🧹 How clean do you keep your space?</label><br>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="cleanliness" value="neat" required>
          <label class="form-check-label">Very neat</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="cleanliness" value="average" required>
          <label class="form-check-label">Average</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="cleanliness" value="relaxed" required>
          <label class="form-check-label">Relaxed</label>
        </div>
      </div>

      <!-- Social Preference -->
      <div class="question">
        <label class="form-label">👥 Social lifestyle?</label><br>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="social_preference" value="very social" required>
          <label class="form-check-label">Very social, I host guests often</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="social_preference" value="occasionally social" required>
          <label class="form-check-label">Occasionally social</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="social_preference" value="private" required>
          <label class="form-check-label">Private and quiet</label>
        </div>
      </div>

      <!-- Noise Tolerance -->
      <div class="question">
        <label class="form-label">🎵 Noise tolerance?</label><br>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="noise_tolerance" value="silent" required>
          <label class="form-check-label">I prefer complete silence</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="noise_tolerance" value="background noise" required>
          <label class="form-check-label">I’m okay with light background noise</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="noise_tolerance" value="loud" required>
          <label class="form-check-label">I’m okay with loud music/conversations</label>
        </div>
      </div>

      <!-- Study Habits -->
      <div class="question">
        <label class="form-label">📚 Study habits?</label><br>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="study_habits" value="scheduled" required>
          <label class="form-check-label">I study at scheduled times</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="study_habits" value="flexible" required>
          <label class="form-check-label">Flexible schedule</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="study_habits" value="late night" required>
          <label class="form-check-label">I study late nights or randomly</label>
        </div>
      </div>

      <button type="submit" class="btn btn-submit">Submit Quiz</button>
    </form>
  </div>

</body>
</html>
