<?php
include "db.php";
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --line: rgb(241, 239, 239);
            --line-strong: rgb(255, 255, 255);
            --text-soft: #c7cdd1;
            --text-muted: #9ca3af;
            --shadow-soft: 0 10px 30px rgba(0, 0, 0, 0.18);
            --radius-lg: 24px;
            --radius-sm: 14px;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(96, 165, 250, 0.08), transparent 28%),
                radial-gradient(circle at top right, rgba(74, 222, 128, 0.08), transparent 30%),
                linear-gradient(135deg, #0d1b3d , #7a3b3b);
            color: #ffffff;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background:linear-gradient(135deg, #0d1b3d , #7a3b3b);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-soft);
            backdrop-filter: blur(16px);
            border-radius: 999px;
            margin: 20px auto;
            max-width: 1400px;
            position: sticky;
            top: 18px;
            z-index: 1000;
            animation: fadeIn 0.8s ease-out both;
        }

        .nav-logo {
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cancel-btn {
            background: transparent;
            color: var(--text-soft);
            border: 1px solid var(--line-strong);
            padding: 9px 22px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .cancel-btn:hover {
            background: rgba(77, 106, 91, 0.5);
            color: #ffffff;
        }

        /* Page Header */
        .page-header {
            max-width: 680px;
            margin: 60px auto 0;
            padding: 0 24px;
            animation: fadeUp 0.9s ease-out both;
        }

        .page-header h1 {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .page-header h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(255,255,255,0.95), rgb(198, 120, 29));
            margin-top: 12px;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 14px;
        }

        /* Form Card */
        .form-section {
            max-width: 680px;
            margin: 36px auto 80px;
            padding: 0 24px;
            animation: fadeUp 0.9s ease-out both;
            animation-delay: 0.1s;
        }

        .form-card {
           background: linear-gradient(135deg, #0d1b3d , #7a3b3b);
            border-radius: var(--radius-lg);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-soft);
            padding: 40px;
        }

        /* Current Image Preview */
        .current-image-wrap {
            margin-bottom: 24px;
        }

        .current-image-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-soft);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
        }

        .current-image-wrap img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 1px solid var(--line-strong);
            display: block;
        }

        /* Form Groups */
        .form-group { margin-bottom: 24px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-soft);
            margin-bottom: 8px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group textarea {
            width: 100%;
            background: linear-gradient(135deg, #7a3b3b, #0d1b3d);
            border: 1px solid var(--line-strong);
            border-radius: var(--radius-sm);
            padding: 14px 18px;
            color: #ffffff;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: rgba(199, 139, 49, 0.4);
            box-shadow: 0 0 0 3px rgba(199, 139, 49, 0.08);
            background: linear-gradient(135deg, #7a3b3b, #0d1b3d);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 110px;
            line-height: 1.6;
        }

        .form-group input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.5;
            cursor: pointer;
        }

        /* File Upload */
        .file-upload-label {
            display: flex;
            align-items: center;
            gap: 14px;
            background: linear-gradient(135deg, #7a3b3b, #0d1b3d);
            border: 1px dashed rgb(255, 255, 255);
            border-radius: var(--radius-sm);
            padding: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .file-upload-label:hover {
            border-color: rgba(199, 139, 49, 0.4);
        }

        .file-upload-icon {
            flex-shrink: 0;
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #7a3b3b, #0d1b3d);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-soft);
        }

        .file-upload-text strong { display: block; font-size: 14px; color: #fff; margin-bottom: 2px; }
        .file-upload-text span { font-size: 12px; color: var(--text-muted); }

        .file-upload-label input[type="file"] {
            position: absolute; inset: 0; width: 100%; height: 100%;
            opacity: 0; cursor: pointer;
        }

        /* Divider */
        .form-divider { height: 1px; background: var(--line); margin: 28px 0; }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #2dd4bf, #0d1b3d);
            color: #ffffff;
            border: 1px solid rgba(255,255,255,0.12);
            padding: 16px 36px;
            border-radius: 999px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(0,0,0,0.18);
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 36px rgba(0,0,0,0.24);
             background: linear-gradient(135deg, #2dd4bf, #0d1b3d);
        }


        @keyframes fadeUp { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        @media (max-width: 768px) {
            .navbar { padding: 14px 20px; margin: 14px 16px; border-radius: 20px; top: 10px; }
            .page-header, .form-section { padding: 0 16px; }
            .form-card { padding: 28px 22px; }
            footer { padding: 20px; }
            .footer-content { flex-direction: column; gap: 16px; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="post.php" class="nav-logo">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#dea34a"><circle cx="12" cy="12" r="10"/></svg>
            Michael Angelo D marinas
        </a>
        <a href="post.php" class="cancel-btn">← Cancel</a>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Edit Post</h1>
        <p>Update the details of your post below.</p>
    </div>

    <!-- Form -->
    <section class="form-section">
        <div class="form-card">

            <form action="update.php" method="POST" enctype="multipart/form-data">

                <!-- Hidden ID -->
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <!-- Hidden old image path -->
                <input type="hidden" name="old_image" value="<?php echo $row['image_path']; ?>">

                <!-- Current Image Preview -->
                <div class="current-image-wrap">
                    <span class="current-image-label">Current Image</span>
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Current Image">
                </div>

                <!-- Change Image -->
                <div class="form-group">
                    <label>Change Image <span style="font-weight:400;text-transform:none;color:var(--text-muted)">(optional)</span></label>
                    <label class="file-upload-label">
                        <div class="file-upload-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21,15 16,10 5,21"/>
                            </svg>
                        </div>
                        <div class="file-upload-text">
                            <strong id="file-name">Choose a new image</strong>
                            <span>Leave blank to keep current image</span>
                        </div>
                        <input type="file" name="image" accept="image/*" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                    </label>
                </div>

                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"><?php echo htmlspecialchars($row['description']); ?></textarea>
                </div>

                <!-- Date -->
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" value="<?php echo $row['date']; ?>" required>
                </div>

                <div class="form-divider"></div>

                <!-- Submit -->
                <button type="submit" class="submit-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Save Changes
                </button>

            </form>
        </div>
    </section>

    <!-- Footer -->
    <

</body>
</html>