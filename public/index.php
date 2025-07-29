<?php
    require_once("./php-scripts/start-session.php");

    if (!isset($_SESSION['userID'])) {
        ob_end_clean(); // Clear any previous output
        echo json_encode(['success' => false, 'error' => 'Unauthorized']);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>
</head>
<body>
    <!-- <h1>Bookstore Management System</h1> -->

    <?php
        include(__DIR__ . "/partials/header.html");
        include("./partials/sidebar-navigation.html");
    ?>

    <div class="container my-5">
        <h1>Home</h1>
    </div>



    <?php
        include("./partials/footer.html");
    ?>
</body>
</html>