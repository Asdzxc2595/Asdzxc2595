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
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&family=Prompt:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
    .login-container {
        padding-left: 30px;
        padding-right: 30px;
        /* align-items: center; */
        /* text-align: center; */
    }


    .admin_login{
        text-align: center; 
    }
    .back-button{
        background-color: red;
        color: aliceblue;
    }
    </style>
</head>

<body>
<section class="login-container">
    <div class = "col-sm-3 admin_login">
    <h2>Admin Login</h2>
    </div>
    <form method="post" action="">
        <div class="row mb-2">
            <label for="username" class="col-sm-1 col-form-label">Username</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputEmail3" name="username" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="password" class="col-sm-1 col-form-label">Password</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" id="inputPassword3" name="password" required>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-1 col-form-label"></label>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary">Sign in</button>
                <a href="index.php" class="btn btn-primary back-button">กลับหน้าหลัก</a>
            </div>
        </div>
    </form>
</section>
<script src="js/script.js"></script>
</body>

</html>