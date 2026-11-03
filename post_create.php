<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $title       = isset($_POST['title'])       ? trim($_POST['title'])       : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $date        = isset($_POST['date'])        ? trim($_POST['date'])        : date('Y-m-d');

    // Handle image upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $ext        = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid('img_', true) . '.' . $ext;

        // Make sure uploads folder exists
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        // Save the file to disk
        $save_to = "uploads/" . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $save_to)) {
            header("Location: post_form.php?error=Failed+to+upload+image");
            exit;
        }

        // Store as "uploads/filename.ext" — same folder as index.php
        // so <img src="uploads/filename.ext"> works correctly on index.php
        $image_path = "uploads/" . $image_name;

    } else {
        header("Location: post_form.php?error=Image+is+required");
        exit;
    }

    if (empty($title)) {
        header("Location: post_form.php?error=Title+is+required");
        exit;
    }

    $stmt = mysqli_prepare($conn,
        "INSERT INTO gallery (title, image_path, description, date) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $title, $image_path, $description, $date);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: post.php?success=1");
    } else {
        header("Location: post_form.php?error=" . urlencode("DB error: " . mysqli_error($conn)));
    }
    exit;

} else {
    header("Location: post_form.php");
    exit;
}
?>