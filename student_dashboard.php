<?php
require 'config.php';

requireRole('student');

$student = $_SESSION['username'];
$studentPhoto = $_SESSION['student_photo'] ?? 'pictures/atc logo.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ATC-SMS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/boxicons.min.css">
    <style>
        body { background-color: #f4f6f9; }
        .service-card {
            border: 1px solid #e3e6ea; border-radius: 10px; padding: 1rem; height: 100%;
            transition: box-shadow 0.2s ease, transform 0.2s ease; text-decoration: none; display: flex; gap: 1rem; align-items: flex-start;
        }
        .service-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); transform: translateY(-2px); }
        .service-icon {
            width: 48px; height: 48px; min-width: 48px; border-radius: 8px; background-color: #eef2ff; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #2d5ed8;
        }
        .service-title { color: #2d5ed8; font-weight: 600; font-size: 0.98rem; margin-bottom: 2px; }
        .service-sub { color: #6c757d; font-size: 0.82rem; margin: 0; }
        .section-label { font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; color: #495057; margin: 1.75rem 0 0.9rem 0; }
        .profile-thumb { width: 54px; height: 54px; object-fit: cover; border-radius: 50%; border: 2px solid #e8ebf5; }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-white border-bottom shadow-sm">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center gap-2">
                <div class="col-2">
                    <img src="pictures/atc logo.png" alt="atc logo" class="col-8">
                </div>
                <div>
                    <div class="fw-bold text-primary" style="font-size:0.8rem;">ATC - SMS</div>
                    <div class="fw-bold" style="font-size:1.2rem;">Student Dashboard</div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="index.php" target="_blank" class="btn btn-light border rounded-circle" aria-label="Open homepage"><i class="bx bx-home"></i></a>
                <div class="dropdown">
                    <button class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <img src="<?= htmlspecialchars($studentPhoto) ?>" alt="Student Photo" class="profile-thumb">
                        <?= htmlspecialchars($student['adno'] ?? $student['Adno'] ?? 'Student'); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="btn w-100 text-start" data-bs-toggle="modal" data-bs-target="#myModal">Profile</button></li>
                        <li><a href="logout.php" class="btn w-100 text-start">Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="myModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title fs-5">Student Profile</div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="<?= htmlspecialchars($studentPhoto) ?>" alt="Student Photo" class="profile-thumb" style="width:80px; height:80px;">
                        <div>
                            <h5 class="mb-0"><?= htmlspecialchars(($student['Fname'] ?? '') . ' ' . ($student['Lname'] ?? '')) ?></h5>
                            <small class="text-muted">Admission No: <?= htmlspecialchars($student['adno'] ?? 'N/A') ?></small>
                        </div>
                    </div>
                    <p>Full name: <strong><?= htmlspecialchars(($student['Fname'] ?? '') . ' ' . ($student['Lname'] ?? '')) ?></strong></p>
                    <p>Email: <strong><?= htmlspecialchars($student['Email'] ?? 'N/A') ?></strong></p>
                    <p>Date of birth: <strong><?= htmlspecialchars($student['DateOfBirth'] ?? $student['DOB'] ?? 'N/A') ?></strong></p>
                    <p>Gender: <strong><?= htmlspecialchars($student['Gender'] ?? 'N/A') ?></strong></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="section-label">ACADEMIC SERVICES</div>
        <div class="row g-3">
            <div class="col-6 col-md-3"><a href="student_services.php?page=register" class="service-card"><div class="service-icon"><i class="bx bx-bookmark"></i></div><div><p class="service-title">Register</p><p class="service-sub">Register for a new semester</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=results" class="service-card"><div class="service-icon"><i class="bx bx-paper"></i></div><div><p class="service-title">Examination Result</p><p class="service-sub">View result and confirmations</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=exam_numbers" class="service-card"><div class="service-icon"><i class="bx bx-book"></i></div><div><p class="service-title">Examination Numbers</p><p class="service-sub">Generate examination number</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=assessment" class="service-card"><div class="service-icon"><i class="bx bx-calendar-check"></i></div><div><p class="service-title">Assessment plans</p><p class="service-sub">View assessment plans</p></div></a></div>
        </div>

        <div class="section-label">IPT AND MANUALS</div>
        <div class="row g-3">
            <div class="col-6 col-md-3"><a href="student_services.php?page=manual" class="service-card"><div class="service-icon"><i class="bx bx-help-circle"></i></div><div><p class="service-title">User Manual</p><p class="service-sub">SMS system guide</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=registration_manual" class="service-card"><div class="service-icon"><i class="bx bx-file"></i></div><div><p class="service-title">Registration Manual</p><p class="service-sub">Online registration guide</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=ipt_manual" class="service-card"><div class="service-icon"><i class="bx bx-book-reader"></i></div><div><p class="service-title">IPT Manual</p><p class="service-sub">IPT system guide</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=arrival_note" class="service-card"><div class="service-icon"><i class="bx bx-send"></i></div><div><p class="service-title">Submit Arrival Note</p><p class="service-sub">Submit IPT arrival note</p></div></a></div>
        </div>

        <div class="section-label">SELF SERVICE REQUESTS</div>
        <div class="row g-3">
            <div class="col-6 col-md-3"><a href="student_services.php?page=postpone" class="service-card"><div class="service-icon"><i class="bx bx-time"></i></div><div><p class="service-title">Postpone Studies</p><p class="service-sub">Request postponement</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=resume" class="service-card"><div class="service-icon"><i class="bx bx-refresh"></i></div><div><p class="service-title">Resume Studies</p><p class="service-sub">Request resumption</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=leave" class="service-card"><div class="service-icon"><i class="bx bx-calendar-x"></i></div><div><p class="service-title">Temporary Leave</p><p class="service-sub">Apply temporary leave</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=clearance" class="service-card"><div class="service-icon"><i class="bx bx-check-circle"></i></div><div><p class="service-title">Graduates Clearance</p><p class="service-sub">Clearance request</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=certificates" class="service-card"><div class="service-icon"><i class="bx bx-award"></i></div><div><p class="service-title">Request Certificates</p><p class="service-sub">Academic certificates</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=provisional" class="service-card"><div class="service-icon"><i class="bx bx-bar-chart-alt-2"></i></div><div><p class="service-title">Provisional Result</p><p class="service-sub">Request provisional result</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=intro_letter" class="service-card"><div class="service-icon"><i class="bx bx-envelope"></i></div><div><p class="service-title">Introduction letter</p><p class="service-sub">Print letter</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=adviser" class="service-card"><div class="service-icon"><i class="bx bx-user-circle"></i></div><div><p class="service-title">Academic Adviser</p><p class="service-sub">View adviser details</p></div></a></div>
        </div>

        <div class="section-label">ACCOUNT AND UTILITIES</div>
        <div class="row g-3">
            <div class="col-6 col-md-3"><a href="student_services.php?page=id_card" class="service-card"><div class="service-icon"><i class="bx bx-id-card"></i></div><div><p class="service-title">Request New ID Card</p><p class="service-sub">Request replacement ID</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=password" class="service-card"><div class="service-icon"><i class="bx bx-lock"></i></div><div><p class="service-title">Change Password</p><p class="service-sub">Update account password</p></div></a></div>
            <div class="col-6 col-md-3"><a href="student_services.php?page=timetable" class="service-card"><div class="service-icon"><i class="bx bx-table"></i></div><div><p class="service-title">Class Time Table</p><p class="service-sub">View timetable</p></div></a></div>
            <div class="col-6 col-md-3"><a href="logout.php" class="service-card"><div class="service-icon"><i class="bx bx-log-out"></i></div><div><p class="service-title">Sign Out</p><p class="service-sub">Exit your account</p></div></a></div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>