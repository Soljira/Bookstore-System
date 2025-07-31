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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>
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
        include("../partials/sidebar-navigation.html");

        // 1.1. Get the selected table
        $selectedTable = $_SESSION['selectedTable'];


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

        // 2. Populate the data with existing data from the selected entry
        include("../php-scripts/generate-input-fields.php");
        generateEditFields($selectedTable, $row, $conn);

        // 3. Update the data in the database
        // handled by generateEditFields and update-data.php

        include("../partials/footer.html");
    ?>
</body>
</html>