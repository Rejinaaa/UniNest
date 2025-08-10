<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

echo "<h2>📝 My Posted Rooms</h2>";

// Fetch rooms posted by the logged-in user
$stmt = $conn->prepare("SELECT * FROM rooms WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($room = $result->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;'>";
        echo "<strong>📍 Location:</strong> " . htmlspecialchars($room['location']) . "<br>";
        echo "<strong>💰 Rent:</strong> Rs. " . htmlspecialchars($room['rent']) . "<br>";
        echo "<strong>🧼 Cleanliness:</strong> " . htmlspecialchars($room['cleanliness']) . "<br>";
        echo "<strong>🛏️ Sleep Schedule:</strong> " . htmlspecialchars($room['sleep_schedule']) . "<br>";
        echo "<strong>💁 Personality:</strong> " . htmlspecialchars($room['personality']) . "<br>";
        echo "<strong>🚻 Gender Preference:</strong> " . htmlspecialchars($room['gender_preference']) . "<br>";
        echo "</div>";
    }
} else {
    echo "❌ You haven’t posted any rooms yet.";
}
?>
