<?php
    require_once("../php-scripts/start-session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>
    
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <?php
        /*
         * 1. Generate the text inputs like in create.php (find a way to modularize the input fields generation)
         *     1.1. Get the selected table /
         *     1.2. Get all its data based on the entry id from the prev page /
         * 2. Populate the data with existing data from the selected entry /
         * 3. Update the data in the database /
         */

        include("../partials/header.html");
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php include("../partials/sidebar-navigation.html"); ?>

            <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <?php
                    // 1.1. Get the selected table
                    $selectedTable = $_SESSION['selectedTable'];
                    $_SESSION['selectedTablePage'] = $_SERVER['HTTP_REFERER'];  // This is for referencing the table name for page navigation purposes in insert-data.php

                    // 1.2. Get all its data based on the entry id from the prev page (get the primary key value)
                    $idName;
                    // Sets the name of the if field of the selected table
                    // TODO: FIND A BETTER WAY TO DO THIS OH MY GOD
                    switch ($selectedTable) {
                        case "authorTable":
                            $idName = "authorID";     
                            break;
                        case "bookTable":
                            $idName = "bookID";     
                            break;
                        case "orderItemTable":
                            $idName = "orderID";
                            break;
                        case "publisherTable":
                            $idName = "publisherID";
                            break;
                        case "users":
                            $idName = "userID";
                            break;
                    } // End of switch statements 

                    // Gets the row based on the entry id (retrieves data from the database)
                    $sql = "SELECT *
                            FROM $selectedTable
                            WHERE $idName = $_GET[$idName]";
                    $result = mysqli_query($conn, $sql); 
                    $row = mysqli_fetch_assoc($result);
                ?>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Edit <?php echo ucfirst(str_replace('Table', '', $selectedTable)); ?></h1>
                </div>

                <?php
                    // 2. Populate the data with existing data from the selected entry
                    include("../php-scripts/generate-input-fields.php");
                    generateEditFields($selectedTable, $row, $conn);

                    // 3. Update the data in the database
                    // handled by generateEditFields and update-data.php
                ?>

            </main>
        </div>
    </div>

    <?php
        include("../partials/footer.html");
    ?>
</body>
</html>