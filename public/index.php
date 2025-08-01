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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>

    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <!-- <h1>Bookstore Management System</h1> -->

    <?php
        include("./partials/header.html");
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php include("./partials/sidebar-navigation.html"); ?>    

            <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Home</h1>               
                </div>
                
                <!-- TODO: CREATE SOME CHARTS OR SOMETHING -->
            </main>
        </div>
    </div>


    <?php
        include("./partials/footer.html");
    ?>
</body>
</html>