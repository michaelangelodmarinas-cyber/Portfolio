

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html { scroll-behavior: smooth; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(250, 96, 127, 0.19), transparent 28%),
                radial-gradient(circle at top right, rgba(222, 116, 74, 0.29), transparent 30%),
                linear-gradient(135deg, #0d1b3d 0%, #7a3b3b  100%);
            color: var(--text-main);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: linear-gradient(135deg, #7a3b3b 0%, #0d1b3d 100%);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-soft);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
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

        .return-btn {
            background: transparent;
            color: var(--text-soft);
            border: 1px solid var(--line-strong);
            padding: 9px 22px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .return-btn:hover {
            background: linear-gradient(135deg, #7a3b3b 0%, #0d1b3d 100%);
            color: #ffffff;
            background: linear-gradient(135deg, #0d1b3d 0%, #7a3b3b 100%);
        }

        /* Page Header */
        .page-header {
            max-width: 680px;
            margin: 60px auto 0;
            padding: 0 24px;
            animation: fadeUp 0.9s ease-out both;
            animation-delay: 0.1s;
        }

        .page-header h1 {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: -0.03em;
            color: #ffffff;
            margin-bottom: 8px;
        }

        .page-header h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(255,255,255,0.95), rgb(4, 4, 4));
            margin-top: 12px;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 16px;
        }

        /* Form Card */
        .form-section {
            max-width: 680px;
            margin: 36px auto 80px;
            padding: 0 24px;
            animation: fadeUp 0.9s ease-out both;
            animation-delay: 0.2s;
        }

        .form-card {
            background: linear-gradient(135deg, #7a3b3b 0%, #0d1b3d 100%);
            border-radius: var(--radius-lg);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-soft);
            padding: 40px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 24px;
        }

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
            background: linear-gradient(135deg, #0d1b3d 0%, #7a3b3b 100%);
            border: 1px solid var(--line-strong);
            border-radius: var(--radius-sm);
            padding: 14px 18px;
            color: #ffffff;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            outline: none;
        }

        .form-group input[type="text"]::placeholder,
        .form-group textarea::placeholder {
            color: var(--text-muted);
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="date"]:focus,
        .form-group textarea:focus {
            background: linear-gradient(135deg, #0d1b3d 0%, #7a3b3b 100%);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(163, 101, 53, 0.2);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 110px;
            line-height: 1.6;
        }

        /* Date input color fix */
        .form-group input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.5;
            cursor: pointer;
        }

        /* File Upload */
        .file-upload-wrap {
            position: relative;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            gap: 14px;
            background: linear-gradient(135deg, #0d1b3d 0%, #7a3b3b 100%);
            border: 1px dashed rgba(255,255,255,0.2);
            border-radius: var(--radius-sm);
            padding: 20px 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            background: linear-gradient(135deg, #0d1b3d 0%, #7a3b3b 100%);
            background: linear-gradient(135deg, #0d1b3d 0%, #7a3b3b 100%);
        }

        .file-upload-icon {
            flex-shrink: 0;
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #7a3b3b 0%, #0d1b3d 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-soft);
        }

        .file-upload-text strong {
            display: block;
            font-size: 14px;
            color: #ffffff;
            margin-bottom: 2px;
        }

        .file-upload-text span {
            font-size: 12px;
            color: var(--text-muted);
        }

        .file-upload-label input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        /* Image Preview */
        #image-preview {
            display: none;
            margin-top: 12px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid var(--line-strong);
        }

        #image-preview img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            display: block;
        }

        /* Divider */
        .form-divider {
            height: 1px;
            background: var(--line);
            margin: 28px 0;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #2dd4bf 0%, #5eead4 100%);
            color: #ffffff;
            border: 1px solid #5eead4;
            padding: 16px 36px;
            border-radius: 999px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.02em;
            box-shadow: 0 8px 24px rgba(0,0,0,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.24);
            background: linear-gradient(135deg, #2dd4bf 0%, #5eead4 100%);
            border-color: rgba(255,255,255,0.2);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Success/Error Message */
        .alert {
            padding: 14px 20px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: rgba(74, 222, 128, 0.12);
            border: 1px solid rgba(74, 222, 128, 0.25);
            color: #4ade80;
        }

        .alert-error {
            background: rgba(248, 113, 113, 0.12);
            border: 1px solid rgba(248, 113, 113, 0.25);
            color: #f87171;
        }

        /* Footer */
        footer {
            
            background: linear-gradient(135deg, #0d1b3d 0%, #7a3b3b  100%);
            padding: 25px 60px;
            margin-top: auto;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            font-size: 14px;
            font-weight: 500;
        }

        .footer-center p { color: #9ca3af; font-size: 13px; }

        .footer-right { display: flex; gap: 25px; }

        .footer-right a {
            color: #dfc69c;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s ease;
        }

        .footer-right a:hover { color: #ffffff; }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { padding: 14px 20px; margin: 14px 16px; border-radius: 20px; top: 10px; }
            .page-header, .form-section { padding: 0 16px; }
            .page-header h1 { font-size: 26px; }
            .form-card { padding: 28px 22px; }
            footer { padding: 20px; }
            .footer-content { flex-direction: column; gap: 16px; text-align: center; }
            .footer-right { justify-content: center; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="index.php" class="nav-logo">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#d19559"><circle cx="12" cy="12" r="10"/></svg>
            michael angelo D marinas
        </a>
        <a href="post.php" class="return-btn">
            ← Return
        </a>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Add New Post</h1>
        <p>Upload an image with title, description, and date to your gallery.</p>
    </div>

    <!-- Form -->
    <section class="form-section">
        <div class="form-card">

            <!-- Show success/error message from upload.php -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="alert alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Post uploaded successfully!
                </div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <form action="post_create.php" method="POST" enctype="multipart/form-data">

                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter post title..." required>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label>Image</label>
                    <div class="file-upload-wrap">
                        <label class="file-upload-label">
                            <div class="file-upload-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21,15 16,10 5,21"/>
                                </svg>
                            </div>
                            <div class="file-upload-text">
                                <strong id="file-name">Choose an image file</strong>
                                <span>JPG, PNG, GIF, WEBP supported</span>
                            </div>
                            <input type="file" name="image" id="image-input" accept="image/*" required onchange="previewImage(this)">
                        </label>
                        <div id="image-preview">
                            <img id="preview-img" src="" alt="Preview">
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Write a short description..."></textarea>
                </div>

                <!-- Date -->
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" required>
                </div>

                <div class="form-divider"></div>

                <!-- Submit -->
                <button type="submit" class="submit-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    Upload Post
                </button>

            </form>
        </div>
    </section>
    <script>
        function previewImage(input) {
            const fileName = document.getElementById('file-name');
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');

            if (input.files && input.files[0]) {
                fileName.textContent = input.files[0].name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Set today's date as default
        document.getElementById('date').valueAsDate = new Date();
    </script>
</body>
</html>