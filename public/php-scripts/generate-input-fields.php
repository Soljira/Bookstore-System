<?php
    // without existing data
    function generateCreateFields($table, $conn) {
        ?><div class="container my-5"> <?php
            $sql = "SHOW COLUMNS FROM $table";
            $result = mysqli_query($conn, $sql);    
            
            $autoIncrementQuery = "SHOW TABLE STATUS LIKE '$table'";
            $autoIncrementResult = mysqli_query($conn, $autoIncrementQuery);
            $autoIncrementRow = mysqli_fetch_assoc($autoIncrementResult);
            $nextID = $autoIncrementRow['Auto_increment'];
            
            while ($row = mysqli_fetch_assoc($result)) {
                // echo htmlspecialchars($row['Field']) . "<br>";
                $columnName = htmlspecialchars($row['Field']);
                // maybe the action should have a variable to specify redirects
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
        </div>
        <?php              
    } // end of generateCreateFields function

    // with existing data
    function generateEditFields($table, $rowData, $conn) {
        ?><div class="container my-5"> <?php
            foreach ($rowData as $key => $value) {
                // maybe the action should have a variable to specify redirects
                ?>
                <form id="editItemForm" method="POST" action="../php-scripts/update-data.php">
                    <div class="row mb-3">
                        <!-- Prints column names -->
                        <label class="col-sm-3 col-form-label">
                            <?php 
                                // This will remove the createdAt input field because createdAt is purely for keeping integrity
                                if ($key != "createdAt") {
                                    echo $key;
                                }
                            ?>
                        </label>
                        <!-- Displays input fields -->
                        <div class="col-sm-6">
                            <?php if ($key == "createdAt") {
                                continue;
                            } elseif (stripos($key, "ID") !== false) { ?>
                                <input type="text" class="form-control" 
                                    name="<?php echo $key; ?>" 
                                    value="<?php echo $value; ?>" readonly>                                    
                            <?php 
                            } else { ?>
                                <input type="text" class="form-control" 
                                    name="<?php echo $key; ?>" 
                                    value="<?php echo $value; ?>">
                            <?php } ?>        
                        </div>            
                    </div>
                    <?php
            }  // end of foreach block ?>
                    <div class="row mb-3">
                        <!-- <label class="col-sm-3 col-form-label">Name</label> -->
                        <div class="offset-sm-3 col-sm-3 d-grid">
                            <button type="submit" class="btn btn-primary" name="editItemSubmit">Submit</button>
                        </div>
                        <div class="col-sm-3 d-grid">
                            <a href="./.." class="btn btn-outline-primary" role="button">Cancel</a>
                            <!-- <input type="text" class="form-control" name="name" value=""> -->
                        </div>
                    </div>
                </form>
        </div>
        <?php              
    } // end of generateCreateFields function
?>