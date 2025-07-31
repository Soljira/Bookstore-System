<?php
    session_start();
    // unset($_SESSION['username']);  // force unauthorization
    // require_once is better than include because it ensures that the file is loaded only once
    require_once(__DIR__ . "/../api/db-connect.php");   // __DIR__ means current directory
    // PHP resolves paths relative to the file being executed, not the file that calls it.
    // so if index.php calls start-session.php, the pathing will skip public because
    // index.php is in the root folder in the first place.

    // Array for storing error messages
    $errors = [];
    if (!empty($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    // Array for storing success messages
    $success = [];
    if (!empty($_SESSION['success'])) {
        $errors = $_SESSION['success'];
        unset($_SESSION['success']);
    }
    // Redirects back to login.php if not logged in
    // This is to prevent people from just bypassing the login page and changing the url to http://localhost:8080/index.php
    if (!isset($_SESSION['username'])) {
        $_SESSION['errors'] = ["Unauthorized"];  // This is what login.php will print
        header('Location: ../actions/login.php');
        exit();
    }
?>