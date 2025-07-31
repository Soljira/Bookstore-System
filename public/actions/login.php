<?php
    session_start();
    $errors = [];
    if (!empty($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }
    include("../api/db-connect.php")
    // include("./partials/header.php");
?>

<!-- USE isset() and empty() -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bookstore System Admin Panel - Login</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <!-- <div class="container">
            <div class="left">
            <img src="../assets/logo.png" alt="Illustration" class="illustration">
            </div> -->
        <div class="right"> 
        <div class="logo">
            <!-- <img src="../assets/icon1.jpg" alt="Bookstore System Logo"> -->
            <h1>Bookstore System Admin Panel</h1>
        </div>
        <h3>Log in to your account</h3>
        
            <?php if (!empty($errors)): ?>
                <div style="color:red; text-align:center; margin-bottom:10px;">
                    <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <form id="loginForm" method="POST" action="../authenticate-user.php">
            <input type="username" id="username" name="username" placeholder="Enter your username">
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <input type="submit" class="btn" value="Log In" name="login"></input>
        </form>

    </body>
</html>
