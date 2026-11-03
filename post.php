<?php include 'db.php'; ?>
<?php
$result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts - michael angelo d marinas.</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --surface: #ffffff;
            --text-main: #ffffff;
            --text-soft: #ffffff;
            --text-muted: #ffffff;
            --line: rgba(150, 150, 150, 0);
            --line-strong: rgba(171, 171, 171, 0);
            --shadow-soft: 0 10px 30px rgba(255, 255, 255, 0);
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background: radial-gradient(circle at top left, rgba(96,165,250,0.08), transparent 28%),
                        radial-gradient(circle at top right, rgba(122,59,59,0.08), transparent 30%),
                        linear-gradient(135deg, #0d1b3d 0%, #7a3b3b  100%);
            color: var(--text-main);
            line-height: 1.6;
            min-height: 100vh;
        }
        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 50px;
            background: linear-gradient(135deg, #0d1b3d 0%, #7a3b3b  100%);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-soft);
            backdrop-filter: blur(16px);
            border-radius: 999px;
            margin: 20px auto;
            max-width: 1400px;
            position: sticky; top: 18px; z-index: 1000;
            animation: fadeIn 0.8s ease-out both;
        }
        .nav-logo { color:#fff; font-size:15px; font-weight:600; text-decoration:none; display:flex; align-items:center; gap:8px; }
        .nav-right { display:flex; align-items:center; gap:12px; }
        .add-btn {
            background: linear-gradient(135deg,rgb(0, 0, 0),rgba(152, 122, 223, 0.96));
            color:#fff; border:1px solid rgba(255,255,255,0.15);
            padding:10px 24px; border-radius:20px; font-size:14px; font-weight:600;
            text-decoration:none; display:inline-flex; align-items:center; gap:6px;
            transition:all 0.3s ease;
        }
        .add-btn:hover { transform:translateY(-2px); box-shadow:0 10px 24px rgb(252, 92, 92); }
        .home-btn {
            background-color:#fff; color:#1a1a1a; border:none;
            padding:10px 28px; border-radius:20px; font-size:14px; font-weight:600;
            text-decoration:none; transition:all 0.3s ease;
        }
        .home-btn:hover { background-color:#f0f0f0; transform:translateY(-2px); }
        .page-header { max-width:1400px; margin:50px auto 30px; padding:0 60px; animation:fadeUp 0.9s ease-out both; }
        .page-header h1 { font-size:38px; font-weight:700; letter-spacing:-0.03em; }
        .page-header h1::after {
            content:''; display:block; width:60px; height:4px; border-radius:999px;
            background:linear-gradient(90deg,rgba(255,255,255,0.95),rgb(194, 98, 60));
            margin-top:10px;
        }
        .posts-count {
            display:inline-block; background:rgba(0, 0, 0, 0.89); border:1px solid var(--line);
            color:var(--text-soft); font-size:12px; padding:4px 12px; border-radius:999px;
            margin-left:12px; vertical-align:middle; font-weight:500;
        }
        .table-section { max-width:1400px; margin:0 auto 80px; padding:0 60px; animation:fadeUp 0.9s ease-out both; animation-delay:0.15s; }
        .table-wrap {
            background:linear-gradient(135deg, #0d1b3d 0%, #7a3b3b  100%);;
            border-radius:20px; border:1px solid var(--line); box-shadow:var(--shadow-soft); overflow:hidden;
        }
        table { width:100%; border-collapse:collapse; }
        thead tr { background:135deg, #0d1b3d 0%, #7a3b3b  100%; border-bottom:1px solid var(--line-strong); }
        thead th { padding:16px 20px; text-align:left; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:var(--text-muted); }
        tbody tr { border-bottom:1px solid var(--line); transition:background 0.2s ease; }
        tbody tr:last-child { border-bottom:none; }
        tbody tr:hover { background:linear-gradient(135deg, #0d1b3d 0%, #7a3b3b  100%); }
        tbody td { padding:22px 20px; font-size:14px; color:var(--text-soft); vertical-align:middle; }
        td.col-id { color:var(--text-muted); font-size:13px; width:60px; }
        td.col-title { font-weight:600; color:#fff; font-size:15px; }
        td.col-image img { width:120px; height:90px; object-fit:cover; border-radius:8px; border:1px solid var(--line-strong); display:block; }
        .no-image { width:80px; height:60px; background:rgba(17, 17, 17, 0.6); border-radius:8px; border:1px dashed var(--line-strong); display:flex; align-items:center; justify-content:center; color:var(--text-muted); }
        td.col-desc { max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-size:13px; }
        td.col-date { font-size:13px; color:var(--text-muted); white-space:nowrap; }
        td.col-action { white-space:nowrap; }
        .btn-edit {
            display:inline-flex; align-items:center; gap:5px;
            background:135deg, #0d1b3d 0%, #7a3b3b  100%; color:#4ade80; border:1px solid rgba(222, 160, 109, 0.25);
            padding:7px 16px; border-radius:8px; font-size:13px; font-weight:600;
            text-decoration:none; transition:all 0.2s ease; margin-right:6px;
        }
        .btn-edit:hover { background:linear-gradient(135deg, #0d1b3d 0%, #7a3b3b  100%); transform:translateY(-1px); }
        .btn-delete {
            display:inline-flex; align-items:center; gap:5px;
            background:rgba(248,113,113,0.12); color:#f87171; border:1px solid rgba(248,113,113,0.25);
            padding:7px 16px; border-radius:8px; font-size:13px; font-weight:600;
            text-decoration:none; transition:all 0.2s ease;
        }
        .btn-delete:hover { background:linear-gradient(135deg, #0d1b3d 0%, #7a3b3b  100%); transform:translateY(-1px); }
        .empty-row td { text-align:center; padding:60px 20px; color:var(--text-muted); }
        footer { background:rgba(26,46,37,0.96); padding:25px 60px; }
        .footer-content { max-width:1400px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; }
        .footer-logo { display:flex; align-items:center; gap:8px; color:#fff; font-size:14px; font-weight:500; }
        .footer-center p { color:#9ca3af; font-size:13px; }
        .footer-right { display:flex; gap:25px; }
        .footer-right a { color:#9ca3af; text-decoration:none; font-size:13px; transition:color 0.3s; }
        .footer-right a:hover { color:#fff; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(28px); } to { opacity:1; transform:translateY(0); } }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @media (max-width:768px) {
            .navbar { padding:14px 20px; margin:14px 16px; border-radius:20px; top:10px; }
            .page-header, .table-section { padding:0 16px; }
            .page-header h1 { font-size:26px; }
            footer { padding:20px; }
            .footer-content { flex-direction:column; gap:16px; text-align:center; }
            .footer-right { justify-content:center; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="nav-logo">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#a76829e0"><circle cx="12" cy="12" r="10"/></svg>
            michael angelo d marinas.
        </a>
        <div class="nav-right">
            <a href="post_form.php" class="add-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Add Post
            </a>
            <a href="index.php" class="home-btn">← Home</a>
        </div>
    </nav>

    <div class="page-header">
        <h1>Posts / Gallery <span class="posts-count"><?= count($rows); ?> posts</span></h1>
    </div>

    <section class="table-section">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): ?>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td class="col-id"><?= $row['id']; ?></td>
                                <td class="col-title"><?= htmlspecialchars($row['title']); ?></td>
                                <td class="col-image">
                                    <?php if (!empty($row['image_path'])): ?>
                                        <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="">
                                    <?php else: ?>
                                        <div class="no-image">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <polyline points="21,15 16,10 5,21"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="col-desc"><?= htmlspecialchars($row['description']); ?></td>
                                <td class="col-date"><?= htmlspecialchars($row['date']); ?></td>
                                <td class="col-action">
                                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="delete.php?id=<?= $row['id']; ?>" class="btn-delete" onclick="return confirm('Delete this post?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="empty-row"><td colspan="6">No posts yet. Click "Add Post" to upload one.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

        </div>
    </footer>
</body>
</html>