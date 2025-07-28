<?php
    require_once("../php-scripts/start-session.php");
    // $test = $_POST['newItem'];
    // echo $test;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>
</head>
<body>
    <!-- Tutorial used: https://www.youtube.com/watch?v=NqP0-UkIQS4 -->
    <!-- TODO: Make switch statements like populateTable -->

    <?php
        include("../partials/header.html");

        $selectedTable = $_POST['newItem'];

        switch ($_POST['newItem']) {
            case "authorNewItem":
                $selectedTable = "authorTable";
                break;
            case "bookNewItem":
                $selectedTable = "bookTable";
                break;
            case "orderNewItem":
                $selectedTable = "orderItemTable";
                break;
            case "publisherNewItem":
                $selectedTable = "publisherTable";
                break;
            case "userNewItem":
                $selectedTable = "users";
                break;
        }

        // 2. Fetch the data from the database (using MySQLi)
        $sql = "SHOW COLUMNS FROM $selectedTable";
        $result = mysqli_query($conn, $sql);
    ?>

    <div class="container my-5">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (mysqli_num_rows($result) > 0) {
                    switch ($_POST['newItem']) {
                        case "authorNewItem":
                            ?><h2>New Author Item</h2><?php                 
                            break;
                        case "bookNewItem":
                            ?><h2>New Book Item</h2><?php                 
                            break;
                        case "orderNewItem":
                            ?><h2>New Order Item</h2><?php                 
                            break;
                        case "publisherNewItem":
                            ?><h2>New Publisher Item</h2><?php                 
                            break;
                        case "userNewItem":
                            ?><h2>New User</h2><?php                 
                            break;
                    } // End of switch statements 
                    
                    // This will print all table columns
                    while ($row = mysqli_fetch_assoc($result)) {
                        $columnName = htmlspecialchars($row['Field']);
                    ?>
                        <form id="newItemForm" method="POST" action=>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    <?php echo $columnName?>
                                </label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="<?php echo $columnName; ?>" value="">
                                </div>
                            </div>
                        <?php
                    }?>
                            <div class="row mb-3">
                                <!-- <label class="col-sm-3 col-form-label">Name</label> -->
                                <div class="offset-sm-3 col-sm-3 d-grid">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <div class="col-sm-3 d-grid">
                                    <a href="./.." class="btn btn-outline-primary" role="button">Cancel</a>
                                    <!-- <input type="text" class="form-control" name="name" value=""> -->
                                </div>
                            </div>
                        </form>
                    <?php                           
    
                } else {
                    echo '<tr><td colspan="8">No data found.</td></tr>';
                }

            } else {
                echo "Not POST";
            }
        ?>
    </div>


    <?php
        include("../partials/footer.html");
    ?>
    
</body>
</html>