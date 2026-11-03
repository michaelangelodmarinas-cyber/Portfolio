<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id          = (int) $_POST['id'];
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $date        = trim($_POST['date']);
    $old_image   = $_POST['old_image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $ext        = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid('img_', true) . '.' . $ext;
        $save_to    = "uploads/" . $image_name;
        $image_path = "uploads/" . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $save_to)) {
            header("Location: edit.php?id=$id&error=Failed+to+upload+image");
            exit;
        }

        // Delete old image file from disk
        if (!empty($old_image) && file_exists($old_image)) {
            unlink($old_image);
        }
    } else {
        $image_path = $old_image;
    }

    $stmt = mysqli_prepare($conn,
        "UPDATE gallery SET title=?, image_path=?, description=?, date=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $image_path, $description, $date, $id);
    mysqli_stmt_execute($stmt);

    header("Location: post.php");
    exit;
}
?>