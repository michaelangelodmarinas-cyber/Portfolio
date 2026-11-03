<?php
/**
 * uploads/index.php
 * 
 * This empty redirect prevents users from browsing the /uploads/ 
 * directory directly in their browser (e.g., localhost/uploads/).
 * Without this, Apache would list all uploaded filenames — a
 * security/privacy issue.
 */
header('Location: ../index.php');
exit();
