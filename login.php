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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&family=Prompt:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="post" action="">
            <div class="form-group-admin">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group-admin">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group-admin">
                <input type="submit" value="Login">
            </div>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
