<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "michael_portfolio_database";

// First, connect without specifying database
$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Try to select database, if it doesn't exist, create it
$check_db = mysqli_query($conn, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'");

if (mysqli_num_rows($check_db) == 0) {
    // Database doesn't exist, create it
    if (!mysqli_query($conn, "CREATE DATABASE $db")) {
        die("Error creating database: " . mysqli_error($conn));
    }
    
    // Select the newly created database
    mysqli_select_db($conn, $db);
    
    // Create posts table
    $create_posts_table = "
        CREATE TABLE posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            image_path VARCHAR(255),
            date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ";
    mysqli_query($conn, $create_posts_table);
    
    // Create gallery table (same structure)
    $create_gallery_table = "
        CREATE TABLE gallery (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            image_path VARCHAR(255),
            date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ";
    mysqli_query($conn, $create_gallery_table);
} else {
    // Database exists, select it
    mysqli_select_db($conn, $db);
    
    // Check if gallery table exists, if not create it
    $check_gallery = mysqli_query($conn, "SHOW TABLES LIKE 'gallery'");
    if (mysqli_num_rows($check_gallery) == 0) {
        $create_gallery_table = "
            CREATE TABLE gallery (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                image_path VARCHAR(255),
                date DATE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB;
        ";
        mysqli_query($conn, $create_gallery_table);
    }
    
    // Check if posts table exists, if not create it
    $check_posts = mysqli_query($conn, "SHOW TABLES LIKE 'posts'");
    if (mysqli_num_rows($check_posts) == 0) {
        $create_posts_table = "
            CREATE TABLE posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                image_path VARCHAR(255),
                date DATE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB;
        ";
        mysqli_query($conn, $create_posts_table);
    }
}
?>