<?php
include("db.php");

echo "<h1>Image Debug Information</h1>";

// Check if uploads folder exists
echo "<h2>Folder Check</h2>";
echo "Uploads folder exists: " . (is_dir("uploads") ? "✓ YES" : "✗ NO") . "<br>";
echo "Image folder exists: " . (is_dir("image") ? "✓ YES" : "✗ NO") . "<br>";
echo "Current working directory: " . getcwd() . "<br>";
echo "Script location: " . __DIR__ . "<br>";

// Check uploads folder contents
echo "<h2>Uploads Folder Contents</h2>";
if (is_dir("uploads")) {
    $files = scandir("uploads");
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $path = "uploads/" . $file;
            $size = filesize($path);
            echo "✓ $file (" . round($size / 1024, 2) . " KB)<br>";
        }
    }
}

// Check database records
echo "<h2>Gallery Database Records</h2>";
$result = mysqli_query($conn, "SELECT id, title, image_path FROM gallery");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $path = $row['image_path'];
        $file_exists = file_exists($path);
        $status = $file_exists ? "✓" : "✗";
        echo "<strong>ID {$row['id']}:</strong> {$row['title']}<br>";
        echo "  Database path: <code>$path</code><br>";
        echo "  File exists: $status " . ($file_exists ? "YES" : "NO - BROKEN LINK") . "<br>";
        echo "  Try URL: <code>/$path</code><br>";
        echo "  Try URL: <code>$path</code><br>";
        echo "<br>";
    }
} else {
    echo "Error querying database: " . mysqli_error($conn);
}
?>
