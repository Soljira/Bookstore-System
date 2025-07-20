<?php
    require_once("../php-scripts/start-session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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

    <!-- 1. Create the table to be filled with data -->
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Created At</th>
        </tr>

        <?php
            include("../php-scripts/populate-table.php");
            populateTable("users", $conn);
            mysqli_close($conn);
        ?>
    </table>

    <?php
        include("../partials/footer.html");
    ?>
</body>
</html>