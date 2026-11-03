<?php
include 'db.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");

header("Location: post.php");
exit();
?>