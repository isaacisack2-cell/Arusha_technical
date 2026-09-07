<?php
require 'config.php';

requireRole('student');

$page = $_GET['page'] ?? 'overview';
$student = $_SESSION['username'];
$studentPhoto = $_SESSION['student_photo'] ?? 'pictures/atc logo.png';

$pages = [
    'register' => [
        'title' => 'Semester Registration',
        'icon' => 'bx bx-bookmark',
        'text' => 'Use this section to confirm your semester registration, review the courses selected, and submit the final semester registration status.',
        'details' => [
            'Current academic year: 2026/2027',
            'Registration status: Pending approval',
            'Deadline: 30th November 2026',
            'Note: Complete all required fee and course confirmations before final submission.'
        ]
    ],
    'results' => [
        'title' => 'Examination Results',
        'icon' => 'bx bx-paper',
        'text' => 'View semester GPA, class performance, and exam confirmations for each course in your study plan.',
        'details' => [
                    'Results are not available in the connected academic database yet.',
                    'Status: Contact the examination office for the latest approved results.',
                    'Action: Review this page after each official result release.'
        ]
    ],
    'exam_numbers' => [
        'title' => 'Examination Numbers',
        'icon' => 'bx bx-book',
        'text' => 'Generate and confirm your examination number, checking it matches the official exam database before the final exam window.',
        'details' => [
                    'Your examination number will appear after academic-office confirmation.',
                    'Candidate status: Awaiting verification',
                    'Action: Contact the examination office if the number is missing.',
                    'Reminder: Keep the approved number for examination and result processing.'
        ]
    ],
    'assessment' => [
        'title' => 'Assessment Plans',
        'icon' => 'bx bx-calendar-check',
        'text' => 'Track coursework, practical assessments, and project deadlines for the current semester.',
        'details' => [
            'CAT 1: 20th October',
            'Practical assessment: 15th November',
            'Final project: 01st December',
            'Support: Academic adviser can help if you miss a task deadline.'
        ]
    ],
    'manual' => [
        'title' => 'User Manual',
        'icon' => 'bx bx-help-circle',
        'text' => 'This guide explains how to navigate the student portal, access services, and complete common tasks without confusion.',
        'details' => [
            'Portal access: Login using admission number or first name',
            'Quick actions: Check results, upload documents, and view announcements',
            'Support: Use the help desk for password issues or system access challenges.'
        ]
    ],
    'registration_manual' => [
        'title' => 'Registration Manual',
        'icon' => 'bx bx-file',
        'text' => 'Follow this manual to complete online registration steps in sequence and avoid missing any required academic confirmation.',
        'details' => [
            'Step 1: Select course and confirm personal details',
            'Step 2: Browse available units and confirm semester fees',
            'Step 3: Submit registration and print a confirmation slip',
            'Tip: Keep a screenshot of the confirmation page for future reference.'
        ]
    ],
    'ipt_manual' => [
        'title' => 'IPT Manual',
        'icon' => 'bx bx-book-reader',
        'text' => 'This section explains Industrial Practical Training requirements, attendance expectations, and reporting responsibilities.',
        'details' => [
            'IPT start date: 10th January 2027',
            'Supervisor: Assigned by department',
            'Requirement: Daily log and weekly progress update',
            'Reminder: Attendance and evaluation are mandatory.'
        ]
    ],
    'arrival_note' => [
        'title' => 'Arrival Note',
        'icon' => 'bx bx-send',
        'text' => 'Submit your arrival note after reporting to your IPT placement or field station.',
        'details' => [
            'Field attachment reference number required',
            'Upload official attachment note or supervisor confirmation',
            'Deadline: Submit within 7 days of arrival',
            'Status: Awaiting verification'
        ]
    ],
    'postpone' => [
        'title' => 'Postpone Studies',
        'icon' => 'bx bx-time',
        'text' => 'If you need to pause studies due to personal, health, or financial reasons, submit a request through this service.',
        'details' => [
            'Processing time: 5 working days',
            'Required documents: reason letter and supporting evidence',
            'Recommendation: discuss with the academic adviser before submission.'
        ]
    ],
    'resume' => [
        'title' => 'Resume Studies',
        'icon' => 'bx bx-refresh',
        'text' => 'Request your return to academic study after a break and confirm your expected resumption date.',
        'details' => [
            'Students may resume at the start of the next semester',
            'Academic records will be reviewed before approval',
            'Action: Submit a formal resumption request and advisory approval.'
        ]
    ],
    'leave' => [
        'title' => 'Temporary Leave',
        'icon' => 'bx bx-calendar-x',
        'text' => 'Apply for a temporary leave of absence if you need time away from the program for a short period.',
        'details' => [
            'Maximum approved leave: one academic year',
            'Documentation: reason statement and supporting letter',
            'Status: Awaiting dean review'
        ]
    ],
    'clearance' => [
        'title' => 'Graduates Clearance',
        'icon' => 'bx bx-check-circle',
        'text' => 'Complete your final graduation clearance to confirm academic, library, and finance records are in order.',
        'details' => [
            'Library clearance: done',
            'Finance clearance: pending',
            'Academic officer review: in progress',
            'Final release: after all departments confirm completion.'
        ]
    ],
    'certificates' => [
        'title' => 'Request Certificates',
        'icon' => 'bx bx-award',
        'text' => 'Request academic transcript, certificate, or official study verification for jobs, scholarships, and further studies.',
        'details' => [
            'Processing time: 7 working days',
            'Required field: student ID and current contact details',
            'Delivery: electronic or physical pickup based on your choice.'
        ]
    ],
    'provisional' => [
        'title' => 'Provisional Results',
        'icon' => 'bx bx-bar-chart-alt-2',
        'text' => 'Download provisional or partial results before the official release for quick academic planning.',
        'details' => [
            'Last updated: 22nd September 2026',
            'Disclaimer: provisional results are subject to final board approval',
            'Contact: Visit the exam office if a subject is missing.'
        ]
    ],
    'intro_letter' => [
        'title' => 'Introduction Letter',
        'icon' => 'bx bx-envelope',
        'text' => 'Generate or request an introduction letter for attachments, internships, scholarship applications, or official institutional communication.',
        'details' => [
            'Letter types: internship, attachment, sponsorship, and academic reference',
            'Approval route: faculty or registrar office',
            'Valid period: 30 days from issue'
        ]
    ],
    'adviser' => [
        'title' => 'Academic Adviser',
        'icon' => 'bx bx-user-circle',
        'text' => 'Meet your academic adviser to discuss study progress, course load, and personal academic improvement plans.',
        'details' => [
            'Academic adviser: Dr. A. Mhando',
            'Office hours: Monday-Friday, 09:00-15:00',
            'Support: course registration, performance review, and guidance on academic pathways.'
        ]
    ],
    'id_card' => [
        'title' => 'Request New ID Card',
        'icon' => 'bx bx-id-card',
        'text' => 'Submit a request for a replacement or reprint of your student ID when your card is lost, damaged, or expired.',
        'details' => [
            'Fee: TSH 15,000',
            'Delivery: student affairs office',
            'Required: current passport photo and student ID number.'
        ]
    ],
    'password' => [
        'title' => 'Change Password',
        'icon' => 'bx bx-lock',
        'text' => 'Improve your account security by updating the password used for portal access and student records.',
        'details' => [
            'Password strength: minimum 8 characters with a mix of letters and numbers',
            'Security reminder: never share your password with classmates or staff.'
        ]
    ],
    'timetable' => [
        'title' => 'Class Timetable',
        'icon' => 'bx bx-table',
        'text' => 'Download or review your class timetable and room allocation for the current academic week.',
        'details' => [
            'Timetable version: Semester 1 - 2026/2027',
            'Priority: Confirm rooms and lecturers before your first class',
            'Changes: Academic office will notify you of updates.'
        ]
    ],
    'overview' => [
        'title' => 'Service Overview',
        'icon' => 'bx bx-grid-alt',
        'text' => 'Welcome to your student service center where you can manage registration, results, approvals, certificates, and essential academic tasks.',
        'details' => [
            'Everything you need is organized by academic work, IPT support, and personal student services.',
            'Use the dashboard cards to open each service and track its current status.'
        ]
    ],
];

$current = $pages[$page] ?? $pages['overview'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($current['title']) ?> | ATC-SMS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/boxicons.min.css">
    <style>
        body { background: #f4f7fb; }
        .content-card { background: white; border-radius: 18px; box-shadow: 0 12px 30px rgba(28,44,89,0.08); }
        .service-icon-lg { width: 92px; height: 92px; border-radius: 20px; background: linear-gradient(135deg, #e1f3e7, #d4ebdc); color: #198754; display:flex; align-items:center; justify-content:center; font-size:2.4rem; }
        .mini-card { border: 1px solid #edf0f6; border-radius: 14px; background: #f9fbff; padding: 1rem; }
        .profile-img { width: 54px; height: 54px; border-radius: 50%; object-fit: cover; border: 2px solid #e8ebf5; }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-white border-bottom shadow-sm px-3">
        <div class="container-fluid">
            <div class="d-flex align-items-center gap-2">
                <img src="pictures/atc logo.png" alt="ATC logo" style="width:48px;">
                <div>
                    <div class="fw-bold text-success" style="font-size:0.8rem;">ATC - SMS</div>
                    <div class="fw-bold">Student Service</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="student_dashboard.php" class="btn btn-light border">Back to dashboard</a>
                <div class="d-flex align-items-center gap-2 border rounded-pill px-2 py-1 bg-light">
                    <img src="<?= htmlspecialchars($studentPhoto) ?>" class="profile-img" alt="Student">
                    <span><?= htmlspecialchars($student['adno'] ?? 'Student') ?></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="content-card p-4 p-md-5">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="service-icon-lg"><i class="<?= htmlspecialchars($current['icon']) ?>"></i></div>
                <div>
                    <p class="text-uppercase text-muted mb-1">Student service</p>
                    <h2 class="mb-0"><?= htmlspecialchars($current['title']) ?></h2>
                </div>
            </div>

            <p class="lead text-secondary"><?= htmlspecialchars($current['text']) ?></p>

            <div class="row g-3 mt-2">
                <?php foreach ($current['details'] as $item): ?>
                    <div class="col-md-6">
                        <div class="mini-card">
                            <i class="bx bx-check-circle text-success me-2"></i>
                            <?= htmlspecialchars($item) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-4 p-3 bg-light rounded">
                <h5 class="mb-2">What this service helps you do</h5>
                <ul class="mb-0">
                    <li>Keep your academic records and approvals up to date.</li>
                    <li>Reduce delays in registration, results, and certificate requests.</li>
                    <li>Stay organized with deadlines, attachments, and student updates.</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
