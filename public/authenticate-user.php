<?php
    session_start();
    $errors=[];
    require_once './api/db-connect.php';

    /*
        1. Check if the submitted credentials aren't empty. If yes, return to login.php
        2. Check if the submitted credentials exist in the database. If no, return to login.php
        3. If user credentials exist and match, go to index.php 
    */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

        /*
            1. Check if the submitted credentials aren't empty. If yes, return to login.php

            will only set the username and password variable if user didn't enter empty credentials
            in login.php
            will also filter and sanitize to block hackers

            Sanitize and validate your inputs to prevent sql injections
            setCookie() and $_SESSION variables too
            passwordVerify()
        */
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // $username = $_POST['username'];
            $username = filter_input(INPUT_POST,
                                    "username", 
                                    FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,
                                    "password", 
                                    FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $_SESSION['errors'] = ["Username and/or password are required"];
            header('Location: ./actions/login.php');
            exit();
        }

        /*
            2. Check if the submitted credentials exist in the database. If no, return to login.php
        */

        // MySQLi querying if user exists in the database
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        // The actual user authentication block
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            /* 
                Verifies if the user's password is correct. If not, go back to login.php
            */
            if (!(password_verify($password, $row['password']))) {  // If password is incorrect
                $_SESSION['errors'] = ["Wrong password"];  // This is what login.php will print
                header('Location: ./actions/login.php');
                mysqli_close($conn);
                exit();
            } else {  // If password is correct
                /*
                    3. If user credentials exist and match, go to index.php
                    stores session data
                    Question: isn't this unsafe? people can just edit this code to
                    include $_SESSION['password'] = $password;
                */
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['username'] = $row['username'];
                header('Location: index.php');
                mysqli_close($conn);
                exit();
            }

        } else {  // Username isn't found in the database
            $_SESSION['errors'] = ["Username doesn't exist"];
            header('Location: ./actions/login.php');
            mysqli_close($conn);
            exit();
        }
    } else {
        echo "Not POST";
    }
?>