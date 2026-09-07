<?php
require 'config.php';

$message = null;
$error = null;
$selectedCourse = strtoupper(trim($_GET['course'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    try {
        $course = strtoupper(trim($_POST['course'] ?? ''));
        $fname = trim($_POST['fname'] ?? '');
        $lname = trim($_POST['lname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $dob = $_POST['DOB'] ?? '';
        $gender = $_POST['gender'] ?? 'male';
        $password = $_POST['password'] ?? '';

        $photoName = null;
        if (!empty($_FILES['photo']['name'])) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed, true)) {
                throw new Exception('Photo must be JPG, JPEG, PNG or GIF.');
            }
            if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {
                throw new Exception('Photo size must be less than 2MB.');
            }

            $targetDir = __DIR__ . '/profiles';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $photoName = 'profile_' . uniqid() . '.' . $ext;
            $targetFile = $targetDir . '/' . $photoName;
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                throw new Exception('Failed to upload photo.');
            }
        }

        $sql1 = $pdo->prepare('SELECT * FROM course WHERE CourseName = :course LIMIT 1');
        $sql1->execute([':course' => $course]);
        $courseRow = $sql1->fetch();

        if (!$courseRow) {
            throw new Exception('Invalid or unknown course name.');
        }

        $sql2 = $pdo->prepare('INSERT INTO registration (paid,profilePicture) VALUES (0.00,?)');
        $sql2->execute([$photoName]);

        $regId = (int) $pdo->lastInsertId();
        $adno = random_int(20000000000, 27000000000);
        $nhif = random_int(2000000000, 3000000000);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $studentInsert = $pdo->prepare(
            'INSERT INTO student (adno, Fname, Lname, Email, DateOfBirth, Gender, NHIF, CourseId, DeptId, RegId, Password, Photo) VALUES (:adno, :fname, :lname, :email, :dob, :gender, :nhif, :courseId, :deptId, :regId, :password)'
        );
        $studentInsert->execute([
            ':adno' => $adno,
            ':fname' => $fname,
            ':lname' => $lname,
            ':email' => $email,
            ':dob' => $dob,
            ':gender' => $gender,
            ':nhif' => $nhif,
            ':courseId' => $courseRow['CourseId'],
            ':deptId' => $courseRow['DeptId'],
            ':regId' => $regId,
            ':password' => $passwordHash
        ]);

        $_SESSION['student_photo'] = $photoName ? 'profiles/' . $photoName : 'pictures/atc logo.png';
        $message = "Registration complete successfully.<br>Your Admission number is: <strong>$adno</strong><br><a href='login.php'>Log in here</a>";
    } catch (Throwable $e) {
        $error = 'Registration failed: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATC-Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card p-4 p-md-5 shadow-sm" style="background-color:rgba(250,253,254,0.95);">
                    <header class="text-center mb-4">
                        <img src="pictures/atc logo.png" alt="ATC-LOGO" class="img-fluid mb-3" style="max-width:120px;">
                        <h1 class="h3">ATC - SMS</h1>
                        <small>Register now to create your student account</small>
                    </header>

                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" name="course" id="course" list="courselist" class="form-control" required placeholder="Enter your course name" value="<?= htmlspecialchars($selectedCourse, ENT_QUOTES, 'UTF-8') ?>">
                            <datalist id="courselist">
                                <option value="IT">Information Technology</option>
                                <option value="CS">Computer Science</option>
                                <option value="CIVIL">Civil Engineering</option>
                                <option value="LAB SCIENCE">Laboratory Science</option>
                                <option value="MECHATRONICS">Mechatronics</option>
                                <option value="TOURISM">Tourism</option>
                                <option value="HOTEL">Hotel Management</option>
                            </datalist>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="DOB" class="form-label">Date Of Birth</label>
                                <input type="date" name="DOB" id="DOB" class="form-control" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="male" class="form-check-input" checked>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="female" class="form-check-input">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="photo" class="form-label">Student Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mt-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Set your SMS password">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success w-100 fw-bold" name="register">REGISTER</button>
                        </div>
                    </form>

                    <p class="mt-3 mb-0">Already registered? <a href="login.php">Log in</a></p>
                    <?php include 'status_box.php'; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>