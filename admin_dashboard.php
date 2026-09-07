<?php
require 'config.php';

requireRole('admin');

function adminData() {
    if (isset($_SESSION['admin_data'])) {
        return $_SESSION['admin_data'];
    }
    return [
        'posts' => [],
        'announcements' => [],
        'documents' => [],
        'students' => []
    ];
}

function saveAdminData($data) {
    $_SESSION['admin_data'] = $data;
}

$notice = null;
$adminData = adminData();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add_post':
                $description = trim($_POST['description'] ?? '');
                $fileName = null;
                if (!empty($_FILES['post_file']['name'])) {
                    $dir = __DIR__ . '/posts';
                    if (!is_dir($dir)) mkdir($dir, 0777, true);
                    $ext = strtolower(pathinfo($_FILES['post_file']['name'], PATHINFO_EXTENSION));
                    $allowed = ['jpg', 'jpeg', 'png', 'mp4', 'gif'];
                    if (!in_array($ext, $allowed, true)) {
                        $notice = 'Only JPG, PNG, GIF, MP4 files are allowed for posts.';
                        break;
                    }
                    $fileName = $dir . '/' . uniqid('', true) . '.' . $ext;
                    move_uploaded_file($_FILES['post_file']['tmp_name'], $fileName);
                    $fileName = str_replace(__DIR__ . '/', '', $fileName);
                }
                $adminData['posts'][] = ['id' => uniqid(), 'name' => $fileName, 'description' => $description, 'post_on' => date('Y-m-d H:i:s')];
                saveAdminData($adminData);
                $notice = 'Post added successfully.';
                break;

            case 'add_announcement':
                $title = trim($_POST['title'] ?? '');
                $content = trim($_POST['content'] ?? '');
                $adminData['announcements'][] = ['id' => uniqid(), 'title' => $title, 'content' => $content, 'created_at' => date('Y-m-d')];                
                $sql = $pdo->prepare("INSERT INTO announcements(title,message) VALUES(:title,:message)");
                $sql->execute([
                    ':title' => $title,
                    ':message' => $content
                ]);
                saveAdminData($adminData);
                $notice = 'Announcement added successfully.';
                break;

            case 'add_document':
                $name = trim($_POST['document_name'] ?? '');
                $fileName = null;
                if (!empty($_FILES['document_file']['name'])) {
                    $dir = __DIR__ . '/documents';
                    if (!is_dir($dir)) mkdir($dir, 0777, true);
                    $ext = strtolower(pathinfo($_FILES['document_file']['name'], PATHINFO_EXTENSION));
                    if (!in_array($ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx'], true)) {
                        $notice = 'Only PDF/DOC/XLS files are allowed for documents.';
                        break;
                    }
                    $fileName = $dir . '/' . uniqid('', true) . '.' . $ext;
                    move_uploaded_file($_FILES['document_file']['tmp_name'], $fileName);
                    $fileName = str_replace(__DIR__ . '/', '', $fileName);
                }
                $adminData['documents'][] = ['id' => uniqid(), 'title' => $name, 'file' => $fileName, 'uploaded_at' => date('Y-m-d H:i:s')];
                saveAdminData($adminData);
                $notice = 'Document uploaded successfully.';
                break;

            case 'delete_post':
                $id = $_POST['id'] ?? null;
                $adminData['posts'] = array_values(array_filter($adminData['posts'], fn($post) => ($post['id'] ?? '') !== $id));
                saveAdminData($adminData);
                $notice = 'Post deleted successfully.';
                break;

            case 'delete_announcement':
                $id = $_POST['id'] ?? null;
                $adminData['announcements'] = array_values(array_filter($adminData['announcements'], fn($item) => ($item['id'] ?? '') !== $id));
                saveAdminData($adminData);
                $notice = 'Announcement deleted successfully.';
                break;

            case 'delete_document':
                $id = $_POST['id'] ?? null;
                $adminData['documents'] = array_values(array_filter($adminData['documents'], fn($item) => ($item['id'] ?? '') !== $id));
                saveAdminData($adminData);
                $notice = 'Document deleted successfully.';
                break;

            case 'delete_student':
                $adno = $_POST['adno'] ?? null;
                $adminData['students'] = array_values(array_filter($adminData['students'], fn($s) => ($s['adno'] ?? '') !== $adno));
                saveAdminData($adminData);
                $notice = 'Student removed successfully.';
                break;
        }
    }
}

try {
    $students = $pdo->query('SELECT * FROM student ORDER BY Fname ASC')->fetchAll();
} catch (Throwable $e) {
    $students = $adminData['students'];
}

try {
    $posts = $pdo->query('SELECT * FROM posts ORDER BY id DESC')->fetchAll();
} catch (Throwable $e) {
    $posts = $adminData['posts'];
}

try {
    $announcements = $pdo->query('SELECT * FROM announcements ORDER BY id DESC')->fetchAll();
} catch (Throwable $e) {
    $announcements = $adminData['announcements'];
}

try {
    $documents = $pdo->query('SELECT * FROM documents ORDER BY id DESC')->fetchAll();
} catch (Throwable $e) {
    $documents = $adminData['documents'];
}

if (empty($adminData['students']) && !empty($students)) {
    $adminData['students'] = $students;
    saveAdminData($adminData);
}
if (empty($adminData['posts']) && !empty($posts)) {
    $adminData['posts'] = $posts;
    saveAdminData($adminData);
}
if (empty($adminData['announcements']) && !empty($announcements)) {
    $adminData['announcements'] = $announcements;
    saveAdminData($adminData);
}
if (empty($adminData['documents']) && !empty($documents)) {
    $adminData['documents'] = $documents;
    saveAdminData($adminData);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/boxicons.min.css">
    <style>
        body { background: #f3f6fb; }
        .stat-box { background: white; border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,.06); padding: 1rem; }
        .panel { background: white; border-radius: 14px; box-shadow: 0 4px 18px rgba(0,0,0,.05); padding: 1.2rem; }
        .table td, .table th { vertical-align: middle; }
        .tiny { font-size: 0.8rem; color: #6c757d; }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-white border-bottom shadow-sm px-4">
        <div class="container-fluid">
            <div>
                <div class="fw-bold text-primary">ATC - SMS</div>
                <h4 class="mb-0">Admin Dashboard</h4>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="index.php" class="btn btn-light border" target="_blank">Home</a>
                <a href="logout.php" class="btn btn-danger text-white">Sign Out</a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <?php if ($notice): ?>
            <div class="alert alert-success"><?= htmlspecialchars($notice) ?></div>
        <?php endif; ?>

        <div class="row g-3 mb-4">
            <div class="col-md-3"><div class="stat-box"><div class="tiny">Total Students</div><h3><?= count($students ?: []) ?></h3></div></div>
            <div class="col-md-3"><div class="stat-box"><div class="tiny">Posts</div><h3><?= count($posts ?: []) ?></h3></div></div>
            <div class="col-md-3"><div class="stat-box"><div class="tiny">Announcements</div><h3><?= count($announcements ?: []) ?></h3></div></div>
            <div class="col-md-3"><div class="stat-box"><div class="tiny">Documents</div><h3><?= count($documents ?: []) ?></h3></div></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="panel mb-4">
                    <h5>Add New Post</h5>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_post">
                        <div class="mb-3">
                            <label class="form-label">Image/Video</label>
                            <input type="file" class="form-control" name="post_file" accept="image/*,video/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Post</button>
                    </form>
                </div>

                <div class="panel mb-4">
                    <h5>Add Announcement</h5>
                    <form method="post">
                        <input type="hidden" name="action" value="add_announcement">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning text-white">Save Announcement</button>
                    </form>
                </div>

                <div class="panel">
                    <h5>Upload Document</h5>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_document">
                        <div class="mb-3">
                            <label class="form-label">Document Name</label>
                            <input type="text" name="document_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">File</label>
                            <input type="file" class="form-control" name="document_file" required>
                        </div>
                        <button type="submit" class="btn btn-success">Upload Document</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="panel mb-4">
                    <h5>Students</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr><th>Admission</th><th>Name</th><th>Email</th><th>Gender</th><th>Action</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($students ?: [] as $student): ?>
                                <tr>
                                    <td><?= htmlspecialchars($student['adno'] ?? $student['Adno'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars(($student['Fname'] ?? '') . ' ' . ($student['Lname'] ?? '')) ?></td>
                                    <td><?= htmlspecialchars($student['Email'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($student['Gender'] ?? 'N/A') ?></td>
                                    <td>
                                        <form method="post" onsubmit="return confirm('Delete this student?');">
                                            <input type="hidden" name="action" value="delete_student">
                                            <input type="hidden" name="adno" value="<?= htmlspecialchars($student['adno'] ?? $student['Adno'] ?? '') ?>">
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel mb-4">
                    <h5>Recent Posts</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>Preview</th><th>Description</th><th>Date</th><th>Delete</th></tr></thead>
                            <tbody>
                            <?php foreach ($posts ?: [] as $post): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($post['name'])): ?>
                                            <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $post['name'])): ?>
                                                <img src="<?= htmlspecialchars($post['name']) ?>" alt="post" style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Media</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($post['description'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($post['post_on'] ?? 'N/A') ?></td>
                                    <td>
                                        <form method="post" onsubmit="return confirm('Delete this post?');">
                                            <input type="hidden" name="action" value="delete_post">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($post['id'] ?? '') ?>">
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel mb-4">
                    <h5>Announcements</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>Title</th><th>Message</th><th>Date</th><th>Delete</th></tr></thead>
                            <tbody>
                            <?php foreach ($announcements ?: [] as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['title'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($item['content'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($item['created_at'] ?? $item['createdOn'] ?? 'N/A') ?></td>
                                    <td>
                                        <form method="post" onsubmit="return confirm('Delete this announcement?');">
                                            <input type="hidden" name="action" value="delete_announcement">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id'] ?? '') ?>">
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel">
                    <h5>Documents</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>Name</th><th>File</th><th>Delete</th></tr></thead>
                            <tbody>
                            <?php foreach ($documents ?: [] as $doc): ?>
                                <tr>
                                    <td><?= htmlspecialchars($doc['title'] ?? $doc['name'] ?? '') ?></td>
                                    <td>
                                        <?php if (!empty($doc['file'])): ?>
                                            <a href="<?= htmlspecialchars($doc['file']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Open</a>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form method="post" onsubmit="return confirm('Delete this document?');">
                                            <input type="hidden" name="action" value="delete_document">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($doc['id'] ?? '') ?>">
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>