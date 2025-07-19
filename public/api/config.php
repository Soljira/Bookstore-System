<?php

/**
 * Simple .env file loader
 * Looks for .env file going up the directory tree
 */
function loadEnvFile() {
    // Start from current directory and go up
    $dir = __DIR__;
    $maxLevels = 5; // Prevent infinite loop
    
    for ($i = 0; $i < $maxLevels; $i++) {
        $envFile = $dir . '/.env';
        
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($lines as $line) {
                // Skip comments
                if (strpos($line, '#') === 0) continue;
                
                // Parse KEY=VALUE format
                if (strpos($line, '=') !== false) {
                    list($key, $value) = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value);
                    
                    // Remove quotes if present
                    $value = trim($value, '"\'');
                    
                    // Set environment variable if not already set
                    if (!getenv($key)) {
                        putenv("$key=$value");
                    }
                }
            }
            return true; // Found and loaded .env file
        }
        
        // Go up one directory
        $dir = dirname($dir);
        
        // Stop if we've reached the root
        if ($dir === dirname($dir)) break;
    }
    
    return false; // .env file not found
}

// Load .env file
$envLoaded = loadEnvFile();

// Get database configuration from environment variables
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'user';
$pass = getenv('DB_PASSWORD');
$db   = getenv('DB_NAME') ?: 'bookstoreDB';
$port = getenv('DB_PORT') ?: 3306;

// Validate that required environment variables are set
if (empty($pass)) {
    $errorMsg = "CONFIGURATION ERROR: DB_PASSWORD not found. ";
    if (!$envLoaded) {
        $errorMsg .= "Could not locate .env file. Please ensure .env file exists in project root.";
    } else {
        $errorMsg .= "Please check your .env file contains DB_PASSWORD.";
    }
    die($errorMsg);
}

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Database connection failed. Please check your configuration (config.php).");
}

// Success check
if (getenv('ENVIRONMENT') === 'development') {
    echo "Connected successfully to database: $db";
    if ($envLoaded) {
        echo " (.env file loaded)";
    }
}
?>