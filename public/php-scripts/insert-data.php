<?php
    require_once("../php-scripts/start-session.php");

    /*
    * 1. Get the current table /
    * 2. Get all the columns from the prev form /
    * 3. Get the auto-incremented ID from the form (changing disabled to readonly will send the data) /
    * 4. Compile all data from the previous page
    * 5. TODO FOR WEDNESDAY: Insert the compile data into database.
    */    

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newItemSubmit'])) {
        // TODO: Get all the columns from the previous page (using $_POST[])
        echo "Selected Table: " . $_SESSION['selectedTable'] . "<br>";  // This is set in create.php in switch statements (line 46)
        $selectedTable = $_SESSION['selectedTable'];

    }
        // Since this file doesn't exactly know which table it's pulling the data from unless the user submitted create.php, use arrays instead
        // this will initialize the arrays because array_push wont work if it didn't
        $columnArrayFields = array();
        $columnArrayValues = array();


        // 2. Fetch the data from the database (using MySQLi)
        // remove createdAt
        $sql = "SHOW COLUMNS FROM $selectedTable";
        
        $result = mysqli_query($conn, $sql);    
        while ($row = mysqli_fetch_assoc($result)) {
            $columnName = $row['Field'];
            // This will remove the createdAt input field because createdAt is purely for keeping integrity
            // MySQL will take care of the createdAt field even without specifying it in INSERT INTO so dont worry            
            if ($columnName != "createdAt") {
                $$columnName = $_POST[$columnName]; 

                array_push($columnArrayFields, $columnName);
                array_push($columnArrayValues, $$columnName);

                // Debugging print statement
                // echo $columnName . ": " .  $$columnName . "<br>";                
            }            
        }

        // Debugging print statements
        // foreach ($columnArrayFields as $field) {
        //     echo "$field <br>";
        // }
        // foreach ($columnArrayValues as $value) {
        //     echo "$value <br>";
        // }



?>



