<?php
session_start();
include("db_connect.php");

// ตรวจสอบการล็อกอิน
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // ใช้ PDO สำหรับการเตรียมและรันคำสั่ง SQL
    $sql = "SELECT * FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $input_username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $input_password == $user['password']) { // ใช้ password_verify() ถ้าใช้ hashed password
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $input_username;
        header("Location: admin/dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error)): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</body>
</html>
