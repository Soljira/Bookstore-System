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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>        
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body class="text-center">
        <form class="form-signin" method="POST" action="../authenticate-user.php">
            <img class="mb-5 logo" src="../assets/logo.png" alt="bookstore logo" width="190" height="150">
            <h1 class="h2 mb-4">Bookstore System Admin Panel</h1>
            <h1 class="h4 mb-3 font-weight-normal">Log in to your account</h1>
            
            <?php if (!empty($errors)): ?>
                <div style="color:red; text-align:center; margin-bottom:10px;">
                    <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>        

            <!-- <label for="username" class="sr-only">Username</label> -->
            <input type="username" id="username" name="username" class="form-control" placeholder="Username" required autofocus>

            <!-- <label for="password" class="sr-only">Password</label> -->
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

            <!-- <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div> -->

            <button class="btn btn-lg btn-primary btn-block mt-1" type="submit" name="login">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; Soljira</p>
        </form>        
    </body>
</html>
