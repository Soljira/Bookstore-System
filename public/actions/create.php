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

    <?php
        include("../partials/header.html");

        $selectedTable = $_POST['newItem'];

        // This will print the errors from insert-data.php
        foreach ($errors as $error): ?>
        <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach;      

                    //         $tables = array();
                    // $sql1 = "SHOW TABLES";
                    // $result1 = mysqli_query($conn,$sql1);

                    // while ($row1= mysqli_fetch_row($result1)) {
                    //     $tables[] = $row1[0];
                    // }       
                    
        // THIS IS FOR KEEPING TRACK OF WHICH TABLE THE PROGRAM IS IN WHEN GENERATING TEXT INPUTS    
        // USED IN LINE 153        
        $tables = array("authorTable","bookTable","orderItemTable", "publisherTable", "users");                              
        $tableIndex = 0;            
        
        // $_SERVER['HTTP_REFERER'] contains the URL of the page that linked to the current page.
        $_SESSION['selectedTablePage'] = $_SERVER['HTTP_REFERER'];  // This is for referencing the table name for page navigation purposes in insert-data.php

        switch ($_POST['newItem']) {
            case "authorNewItem":
                $selectedTable = "authorTable";
                $tableIndex = 0;
                break;
            case "bookNewItem":
                $selectedTable = "bookTable";
                $tableIndex = 1;
                break;
            case "orderNewItem":
                $selectedTable = "orderItemTable";
                $tableIndex = 2;
                break;
            case "publisherNewItem":
                $selectedTable = "publisherTable";
                $tableIndex = 3;
                break;
            case "userNewItem":
                $selectedTable = "users";
                $tableIndex = 4;
                break;
        }

        // TODO: ID not autoincrementing when inserting new data

        $_SESSION['selectedTable'] = $selectedTable;  // This is for referencing the actual table name in insert-data.php

        // 2. Fetch the data from the database (using MySQLi)
        $sql = "SHOW COLUMNS FROM $selectedTable";
        
        // THIS WILL ONLY FETCH THE TABLE COLUMN NAMES
        $result = mysqli_query($conn, $sql);    
        while ($row = mysqli_fetch_assoc($result)) {
            $columnName = $row['Field'];
            // foreach ($columnName as $value) {
            //     echo $value;

            // }
            // echo $columnName;
            $$columnName = null;

            // if (isset($_POST[$columnName])) {
            //     $$columnName = $_POST[$columnName];  // $$ is a variable variable
            //     // echo "test";
            // } else {
            //     // echo "test";

            //     $$columnName = null;
            // }
        }

        // Resets $row DO NOT COMMENT THIS OUT BECAUSE TEXT INPUTS WONT WORK
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

                    
                    // Get the next AUTO_INCREMENT value for the selected table
                    // Why is this not working for userID?
                    /* 
                     * Fixed this by manually inserting the initial user in mysql command line
                     * Entering data via adminer doesn't work somehow. Find out why and fix adminer
                     */
                    $autoIncrementQuery = "SHOW TABLE STATUS LIKE '$selectedTable'";
                    $autoIncrementResult = mysqli_query($conn, $autoIncrementQuery);
                    $autoIncrementRow = mysqli_fetch_assoc($autoIncrementResult);
                    $nextID = $autoIncrementRow['Auto_increment'];
                    
                    // Debugging print statements
                    // echo "Selected table " . $selectedTable . "<br>";
                    // echo "Next ID: " . $nextID;

                    // This will print all table columns
                    while ($row = mysqli_fetch_assoc($result)) {
                        // $tableCount = 0;
                        // echo $tables[$tableIndex];
                        $columnName = htmlspecialchars($row['Field']);
                        // $columnName;
                    ?>
                        <form id="newItemForm" method="POST" action="../php-scripts/insert-data.php">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    <?php 
                                        // This will remove the createdAt input field because createdAt is purely for keeping integrity
                                        if ($columnName != "createdAt") {
                                            echo $columnName;
                                        }
                                    ?>
                                </label>
                                <div class="col-sm-6">
                                    <?php if ($columnName == "createdAt") {
                                        continue;
                                    } elseif ($tables[$tableIndex] == "orderItemTable") {   //whats this??>
                                        <input type="text" class="form-control" 
                                            name="<?php echo $columnName; ?>" 
                                            value="">                                    
                                    <?php                                     
                                    } elseif (stripos($columnName, "ID") !== false) { ?>
                                        <input type="text" class="form-control" 
                                            name="<?php echo $columnName; ?>" 
                                            value="<?php echo $nextID; ?>" readonly>                                    
                                    <?php 
                                    } else { ?>
                                        <input type="text" class="form-control" 
                                            name="<?php echo $columnName; ?>" 
                                            value="">
                                    <?php } ?>
                                </div>
                            </div>
                        <?php
                    }?>
                            <div class="row mb-3">
                                <!-- <label class="col-sm-3 col-form-label">Name</label> -->
                                <div class="offset-sm-3 col-sm-3 d-grid">
                                    <button type="submit" class="btn btn-primary" name="newItemSubmit">Submit</button>
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