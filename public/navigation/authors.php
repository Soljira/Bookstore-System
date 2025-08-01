<?php
    require_once("../php-scripts/start-session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>
    
    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <!-- 
        1. Create the table to be filled with data
        2. Fetch the data from the database (using MySQLi); table should be determined by the current page
        3. Populate the table with the fetched data
    -->
    
    <!-- TODO: PAGINATION https://www.youtube.com/watch?v=3-5DpAiCHy8 -->
    
    <?php
        include("../partials/header.html");
    ?>


    <div class="container-fluid">
        <div class="row">
            <?php include("../partials/sidebar-navigation.html"); ?>    

            <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Authors</h1>

                    <form method="POST" action="../actions/create.php?authorTable">
                        <button type="submit" name="newItem" value="authorNewItem" class="btn btn-success">+ New Item</button>
                    </form>                    
                </div>
                
                <!-- 1. Create the table to be filled with data -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("../php-scripts/populate-table.php");
                                populateTable("authorTable", $conn);
                                $_SESSION['selectedTable'] = "authorTable";  // This is for referencing the actual table name in insert-data.php
                                mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php
        include("../partials/footer.html");
    ?>
</body>
</html>