<?php
include "db.php";

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query all posts
$result = mysqli_query($conn, "SELECT * FROM gallery");

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<h1>Database Debug</h1>";
echo "<p>Total posts: " . count($posts) . "</p>";

if (count($posts) > 0) {
    echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Title</th><th>Image Path</th><th>Description</th><th>Date</th></tr>";
    
    foreach ($posts as $post) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($post['id']) . "</td>";
        echo "<td>" . htmlspecialchars($post['title']) . "</td>";
        echo "<td>" . htmlspecialchars($post['image_path']) . "</td>";
        echo "<td>" . htmlspecialchars($post['description']) . "</td>";
        echo "<td>" . htmlspecialchars($post['date']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No posts found in database</p>";
}

mysqli_close($conn);
?>
