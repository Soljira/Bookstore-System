<?php
    require_once("../php-scripts/start-session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publishers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>
</head>
<body>
    <!-- 
        1. Create the table to be filled with data
        2. Fetch the data from the database (using MySQLi); table should be determined by the current page (see populate-table.php)
        3. Populate the table with the fetched data (see populate-table.php)
    -->
    
    <!-- TODO: PAGINATION https://www.youtube.com/watch?v=3-5DpAiCHy8 -->
    
    <?php
        include("../partials/header.html");
        include("../partials/sidebar-navigation.html");
    ?>

    <div class="container my-5">
        <h2>Publishers</h2>
        <!-- <a href="../actions/create.php" class="btn btn-primary" role="button">New Item</a> -->
        <form method="POST" action="../actions/create.php?publisherTable">
            <button type="submit" name="newItem" value="publisherNewItem" class="btn btn-success">+ New Item</button>
        </form>             
        
        <!-- 1. Create the table to be filled with data -->
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                include("../php-scripts/populate-table.php");
                populateTable("publisherTable", $conn);
                mysqli_close($conn);
            ?>
        </table>
    </div>

    <?php
        include("../partials/footer.html");
    ?>
</body>
</html>