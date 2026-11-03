<?php
/**
 * Database Setup Script
 * Run this once to create the database and tables
 * Access via: http://localhost/portfolio/setup.php
 */

$host = "localhost";
$user = "root";
$pass = "";

// Connect without selecting database
$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$db_name = "michael_portofolio_database";

// Create database
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $db_name";
if (mysqli_query($conn, $sql_create_db)) {
    echo "✔ Database created successfully.<br>";
} else {
    die("✗ Error creating database: " . mysqli_error($conn));
}

// Select the database
mysqli_select_db($conn, $db_name);

// Create posts table
$sql_create_table = "
    CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image_path VARCHAR(255),
        date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
";

if (mysqli_query($conn, $sql_create_table)) {
    echo "✔ Posts table created successfully.<br>";
} else {
    die("✗ Error creating table: " . mysqli_error($conn));
}

// Create gallery table (if you need it separately)
$sql_create_gallery = "
    CREATE TABLE IF NOT EXISTS gallery (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image_path VARCHAR(255),
        date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
";

if (mysqli_query($conn, $sql_create_gallery)) {
    echo "✔ Gallery table created successfully.<br>";
} else {
    die("✗ Error creating gallery table: " . mysqli_error($conn));
}

mysqli_close($conn);

echo "<br><strong style='color: green;'>✔ Database setup complete!</strong><br>";
echo "You can now delete this file and use your portfolio.<br>";
echo "<a href='index.php'>Go to Portfolio</a>";
?>
