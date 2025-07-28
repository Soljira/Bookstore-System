<?php
    // TODO: Input validation
    // TODO: Filter and sanitize

    /*
        1. Create the table to be filled with data (already done in the prev page)
        2. Fetch the data from the database (using MySQLi); table should be determined by the current page
        3. Populate the table with the fetched data
    */
    function populateTable($table, $conn) {
        // I don't need to include the db-connect.php file because I already passed $conn as an argument

        // 2. Fetch the data from the database (using MySQLi)
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql);

        // 3. Populate the table with the fetched data
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                switch ($table) {
                    case "authorTable":
                        ?> <!-- Closes the first php tag to do some HTML -->
                        <tr>
                            <!-- This will create rows accdg. to the database data -->
                            <td><?php echo htmlspecialchars($row['authorID']) ?></td>
                            <td><?php echo htmlspecialchars($row['authorName']) ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="../actions/edit.php">Edit</a>
                                <a class="btn btn-danger btn-sm" href="../actions/delete.php">Delete</a>
                            </td>
                        </tr>
                        <?php // Back to php; the closing tag should be the one in the end
                        break;
                    case "bookTable":
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['bookID']) ?></td>
                            <td><?php echo htmlspecialchars($row['bookTitle']) ?></td>
                            <td><?php echo htmlspecialchars($row['bookAuthor']) ?></td>
                            <td><?php echo htmlspecialchars($row['bookPublisher']) ?></td>
                            <td><?php echo htmlspecialchars($row['bookPublicationDate']) ?></td>
                            <td><?php echo htmlspecialchars($row['bookGenre']) ?></td>
                            <td><?php echo htmlspecialchars($row['bookQuantity']) ?></td>
                            <td><?php echo htmlspecialchars($row['bookPrice']) ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="../actions/edit.php">Edit</a>
                                <a class="btn btn-danger btn-sm" href="../actions/delete.php">Delete</a>
                            </td>                            
                        </tr>
                        <?php
                        break;
                    case "orderItemTable":
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['orderID']) ?></td>
                            <td><?php echo htmlspecialchars($row['bookID']) ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']) ?></td>
                            <td><?php echo htmlspecialchars($row['unitPrice']) ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="../actions/edit.php">Edit</a>
                                <a class="btn btn-danger btn-sm" href="../actions/delete.php">Delete</a>
                            </td>                            
                        </tr>
                        <?php
                        break;

                    case "publisherTable":
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['publisherID']) ?></td>
                            <td><?php echo htmlspecialchars($row['publisherName']) ?></td>
                            <td><?php echo htmlspecialchars($row['publisherAddress']) ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="../actions/edit.php">Edit</a>
                                <a class="btn btn-danger btn-sm" href="../actions/delete.php">Delete</a>
                            </td>                            
                        </tr>
                        <?php
                        break;

                    case "users":
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['userID']) ?></td>
                            <td><?php echo htmlspecialchars($row['username']) ?></td>
                            <td><?php echo htmlspecialchars($row['password']) ?></td>
                            <td><?php echo htmlspecialchars($row['createdAt']) ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="../actions/edit.php">Edit</a>
                                <a class="btn btn-danger btn-sm" href="../actions/delete.php">Delete</a>
                            </td>                            
                        </tr>
                        <?php
                        break;
                    default:
                        echo "Table not found";
                        break;
                }
            }
        } else {
            echo '<tr><td colspan="8">No data found.</td></tr>';
        }
    }
?>