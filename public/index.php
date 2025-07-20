<?php
    require_once("./php-scripts/start-session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <!-- <h1>Bookstore Management System</h1> -->

    <?php
        include(__DIR__ . "/partials/header.html");
        include("./partials/sidebar-navigation.html");
    ?>

    <h1>Home</h1>



    <?php
        include("./partials/footer.html");
    ?>
</body>
</html>