<?php
require "config.php";

if(!isset($_COOKIE['role']) && !isset($_SESSION['username']) && $_COOKIE['role'] != 'student'){
    header("location:login.php");
    exit();
}
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
        body{
            background-color: #f4f6f9;
        }

        .service-card{
            border: 1px solid #e3e6ea;
            border-radius: 10px;
            padding: 1rem;
            height: 100%;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
            text-decoration: none;
            display: flex;
            gap: irem;
            align-items: flex-start;
        }

        .service-card:hover{
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }

        .service-icon{
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 8px;
            background-color: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #2d5ed8;
        }

        .service-title{
            color: #2d5ed8;
            font-weight: 600;
            font-size: 0.98rem;
            margin-bottom: 2px;
        }

        .service-sub{
            color: #6c757d;
            font-size: 0.82rem;
            margin: 0;
        }

        .section-label{
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            color: #495057;
            margin: 1.75rem 0 0.9rem 0;
        }
    </style>
</head>
<body>
    <!--header TOP HEADER-->
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
                <button class="btn btn-light border rounded-circle">
                    <a href="index.php" target="_blank"><i class="bx bx-home"></i></a>
                </button>
                <div class="dropdown">
                    <button class="btn btn-light border dropdown-toggle" data-bs-toggle="dropdown">
                        <?= $_SESSION['username']['adno']; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="btn" data-bs-toggle="modal" data-bs-target="#myModal">Profile</button></li>
                        <li><a href="logout.php"><button class="btn">Sign Out</button></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <!-- Profile Modal -->
    <div class="modal fade" id="myModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Student Profile</div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>full name: <span><strong><?= $_SESSION['username']['Fname']." ".$_SESSION['username']['Lname']; ?></strong></span></p>
                    <p>Email: <strong><?= $_SESSION['username']['Email']; ?></strong></p>
                    <p>Date of birth: <strong><?= $_SESSION['username']['DateOfBirth']; ?></strong></p>
                    <p>Gender: <strong><?= $_SESSION['username']['Gender']; ?></strong></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


        <div class="container my-4">
        <!--ACADEMIC SERVICES-->
        <div class="section-label">
            ACADEMIC SERVICES
        </div>

        <div class="row g-3">
            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx bx-bookmark"></i></div>
                    <div>
                        <p class="service-title">Register</p>
                        <p class="service-sub">register for a new semister</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx bx-paper"></i></div>
                    <div>
                        <p class="service-title">Examination Result</p>
                        <p class="service-sub">View result and confirmations</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx bx-book"></i></div>
                    <div>
                        <p class="service-title">Examination Numbers</p>
                        <p class="service-sub">Generate Examination number</p>
                    </div>
                </a>
            </div>
            
            <div class="col-6 col-md-3">
                    <a href="#" class="service-card">
                        <div class="service-icon"><i class="bx"></i></div>
                        <div>
                            <p class="service-title">Assessment plans</p>
                            <p class="service-sub">View assessment plans</p>
                        </div>
                    </a>
                </div>
            </div>

        <!--IPT SERVICES-->
        <div class="section-label">
            IPT AND MANUALS
        </div>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <a  href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">User Manual</p>
                        <p class="service-sub">SMS Systen guide</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Registration Manual</p>
                        <p class="service-sub">Online Registration guide</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">IPT Manual</p>
                        <p class="service-sub">IPT System guide</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Submit Arrival Note</p>
                        <p class="service-sub">Submit IPT Arrival note</p>
                    </div>
                </a>
            </div>  
        </div>          

        <!-- SELF SERVISES REQUESTS -->
        <div class="section-label">
            SELF SERVICE REQUESTS
        </div>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Postpone Studies</p>
                        <p class="service-sub">Request Study postponement</p>
                    </div>
                </a>
            </div>
            
            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Resume Studies</p>
                        <p class="service-sub">Request Study resumption</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Temporary Leave</p>
                        <p class="service-sub">Apply for temporary leave</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Graduates Clearence</p>
                        <p class="service-sub">Clearance request</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Request Certificates</p>
                        <p class="service-sub">Academic certificates</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Provisional Result</p>
                        <p class="service-sub">Request provisional results</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Introduction letter</p>
                        <p class="service-sub">Print introduction letter</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Academic Adviser</p>
                        <p class="service-sub">View adviser details</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- ACCOUNT AND UTILITIES -->
         <div class="section-label">
            ACCOUNT AND UTILITIES
         </div>
         <div class="row g-3">
            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Request New ID Card</p>
                        <p class="service-sub">Request replacement ID</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="reset.html" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Change Password</p>
                        <p class="service-sub">Update account password</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Class Time Table</p>
                        <p class="service-sub">View Class Timetable</p>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="logout.php" class="service-card">
                    <div class="service-icon"><i class="bx"></i></div>
                    <div>
                        <p class="service-title">Sign Out</p>
                        <p class="service-sub">Exit Your Account</p>
                    </div>
                </a>
            </div>
         </div>
    </div>

    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>