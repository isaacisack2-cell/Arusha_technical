<?php
require "config.php";
try{
    $sql = $pdo->prepare("SELECT * FROM POSTS ORDER BY id DESC limit 4");
    $sql->execute();
    $result = $sql->fetchAll();

    $announcements = $pdo->prepare("SELECT * FROM announcements ORDER BY Id limit 5");
    $announcements->execute();
    $announcementsResult = $announcements->fetchAll();

}catch(PDOException $e){
    $error = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome ATC - Arusha Technical College</title>
    <link rel="stylesheet" href="style2.css?v=20260907">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!--1. STICK TOP NAV BAR-->
    <header class="navbar">
        <div class="nav-container">
            <!--mobile hambergar button left-->
            <button class="icon-btn mobile-only" id="hambugerBtn" aria-label="Toggle Navigation">
                <i class="bx bx-menu"></i>
            </button>

            <!--Brand Title-->
            <div class="brand-title">
                <h2 aria-label="Arusha Technical College"></h2>
            </div>

            <!--Desktop navigation link-->
            <nav class="desktop-nav desktop-only">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="login.php">ATC-SMS</a></li>
                    <li><a href="register.php">Admissions</a></li>
                    <li><a href="#documents">Research &amp; documents</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>

            <!--Mobile Three Dot Button-->
            <button class="icon-btn mobile-only" id="infoBtn" aria-label="Toggle Contact Info">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
    </header>

    <!--MOBILE SIDEBAR NAVIGATION DRAWER-->
    <aside class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            <h3>ATC Navigations</h3>
            <button class="close-btn" id="closeDrawer">&times;</button>
        </div>
        <ul class="drawer-links">
            <li><a href="index.php"><i class="fa-solid fa-house"></i>Home</a></li>
            <li><a href="about.php"><i class="fa-solid fa-circle-info"></i>About ATC</a></li>
            <li><a href="login.php"><i class="fa-solid fa-graduation-cap"></i>ATC-SMS</a></li>
            <li><a href="register.php"><i class="fa-solid fa-file-pen"></i>Admissions</a></li>
            <li><a href="#recentPosts"><i class="fa-solid fa-newspaper"></i>News &amp; announcements</a></li>
            <li><a href="#documents"><i class="fa-solid fa-folder-open"></i>Document Center</a></li>
            <li><a href="contact.php"><i class="fa-solid fa-phone"></i>Contact ATC</a></li>
        </ul>
    </aside>

    <!--MOBILE CONTACT INFO POPUP (THREE DOTS)-->
    <div class="info-model" id="infoModel">
        <div class="info-content">
            <button class="close-btn" id="closeInfo">&times;</button>
            <h3><i class="fa-solid fa-location-dot"></i>ATC Quick Info</h3>
            <div class="info-details">
                <p><strong>Location:</strong>Junction Of Moshi - Arusha and Nairobi Roads</p>
                <p><strong>Address:</strong>P.O.BOX 296, Arusha - Tanzania</p>
                <p><strong>Phone:</strong>+255 27 297 0056</p>
                <p><strong>Email:</strong>rector@atc.ac.tz</p>
            </div>
        </div>
    </div>

    <!-- OVERLAY BACKGROUND FOR MOBILES -->
     <div class="overlay" id="overlay"></div>

     <!--2. AUTO SCROLLING SLIDER-->
     <section class="slider-section">
        <div class="slider-wrapper" id="slideWrapper">
            <div class="slide active">
                <img src="./pictures/pic1.jpg" alt="banner1">
            </div>
            <div class="slide">
                <img src="./pictures/pic2.jpg" alt="banner2">
            </div>
            <div class="slide">
                <img src="./pictures/pic3.jpg" alt="banner3">
            </div>
            <div class="slide">
                <img src="./pictures/pic4.jpg" alt="banner3">
            </div>
            <div class="slide">
                <img src="./pictures/pic5.jpg" alt="banner3">
            </div>
            <div class="slide">
                <img src="./pictures/pic6.jpg" alt="banner3">
            </div>            
            <div class="slide">
                <img src="./pictures/pic7.jpg" alt="banner3">
            </div>            
            <div class="slide">
                <img src="./pictures/pic8.jpg" alt="banner3">
            </div>            
            <div class="slide">
                <img src="./pictures/pic9.jpg" alt="banner3">
            </div>            
            <div class="slide">
                <img src="./pictures/pic10.jpg" alt="banner3">
            </div>            
            <div class="slide">
                <img src="./pictures/pic11.jpg" alt="banner3">
            </div>            
            <div class="slide">
                <img src="./pictures/pic12.jpg" alt="banner3">
            </div>            
            <div class="slide">
                <img src="./pictures/pic13.jpg" alt="banner3">
            </div>                      
        </div>
        <button class="slide-btn prev-btn" id="prevBtn"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="slide-btn next-btn" id="nextBtn"><i class="fa-solid fa-chevron-right"></i></button>
     </section>

    <!--MAIN CONTENT CONTAINER--> 
    <main class="main-container">

        <!--message from rector-->
        <section class="card-box" id="programmes">
            <h3 class="section-title" id="messageFromRector">MESSAGE FROM THE RECTOR</h3>
            <div class="rector-card">
                <img src="./pictures/rector.jpg" alt="prof Musa N. Chacha" class="rector-img">
                <h4>Prof. Musa N. Chacha</h4>
                <p class="subtitle">Rector</p>
                <p class="text-content">
                    I'm pleased to introduce you to the Arusha Technical College (ATC). Choosing the right college is the major decission and it's importtant that You choose the one that's right for you. Our website indicates whats its like to be student ar Arusha Techinical COllege in the words of the people who know it best - Our students past and present and staff however, a website can only go so far and the best way to gain an insight into life at Arusha Technical College is to visit us and experience it for yourself. <br>Our college is located at the Central Bussiness District of Arusha City which has populated over two millions depending mainly on agriculture, commerce, trade and tourism for economic purposes. The city is also the headquarters of East African Community (EAC) and the doors to the world's great wildlife heritage, including Ngorongoro Crater, Serengeti and Lake Manayara national parks.... 
                    <a href="#more" id="readMore">Read More</a>
                    <p id="more">
                        It is such a milieu that makes the College’s location an ideal place for education, training and applied researches
As you go through the Website you will find information that best describe the College. The ATC staff are student centered, carrier focused and committed to student success. Our hands-on (competence based) philosophy distinguishes ATC from many other technical institutions in Tanzania and the East African region. This Website also provides comprehensive information on the academic programmes currently being offered at ATC. It is intended to serve as a guide to prospective and ongoing students in planning their study programmes as it provides an exhaustive list of all the programmes as well as the respective entry and graduation requirements. The College aspires to become a society with practical knowledge, skills and attitudes for sustainable development. With a view of realization of its aspirations, the College by 2023 has twenty-seven (27) Technical Education Training (TET) programmes (18) diploma programmes and nine (9) bachelor’s programmes. The College is also registered by Vocational Education Training Authority (VETA) to train Artisans (NVAs 1-3). Currently the College has twenty-three (23) Vocational Education Training (VET) programmes. This is the only College where you can find this Programme in Tanzania. In so doing the College supports the growth and development of economy in the East African Region and beyond. As results of its expansion over 40 years, ATC has introduced new Campus in Chemka Village, Hai District (Kikuletwa Campus) which is mainly for renewable energy training and power production. The College also has training area in Oljoro, Arusha District responsible for irrigated agriculture training. It is ATC goal to offer students’ knowledge and skills to successfully enter the world of work particularly engineering and service industries as professionals who will make a difference in everything, they do whether as employees, self-employed or employers.
Our Student Services team will be here to support you through your studies. We want to ensure that you not only gain the knowledge you require to succeed in your career, but that you also enjoy the full College experience we offer. The Arusha Technical College graduates are known for making a big difference in the market around them and we look forward to helping you do the same as you embark on your learning and career goals with us.
                        <br><span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;text-align: center;width: 100%;">SKILLS MAKE THE DIFFERENCE</span>
                        <br><span style="color:#12633e;width: 100%;">Prof. Mussa N. Chacha</span>
                        <br><span style="font-weight: bold;width: 100%;">Rector</span>
                        <br><a href="#messageFromRector" id="readLess">Read less</a>
                    </p>
                </p>
            </div>
        </section>

        <!--Search programme -->
        <section class="card-box">
            <h3 class="section-title">Search Programme</h3>
            <div class="section-form">
                <select class="input-select" id="programmeSelect" aria-label="Select a programme">
                    <option value="">-- Enter Programme Keyword --</option>
                    <option value="ict">Information Technology</option>
                    <option value="civil">Civil Engineering</option>
                    <option value="electrical">Electrical Engineering</option>
                </select>
                <button type="button" class="btn-search" id="programmeButton"><i class="fa-solid fa-magnifying-glass"></i>View Programme Details</button>
                <p id="programmeMessage" class="programme-message" role="status" aria-live="polite"></p>
            </div>
        </section>

        <section class="atcDocument">
        <!--Recent posts-->
        <section class="card-box" id="recentPosts">
            <h3 class="section-title">Recent Posts</h3>
            <?php if(isset($result)): ?>
            <ul class="list-posts">
                <?php foreach($result as $row): ?>
                <li>
                    <div class="postImg"><img src="<?= $row['name'] ?>" alt="post thumb"></div>
                    <div>
                        <a href="https://www.youtube.com/results?search_query=<?= urlencode($row['description'] . ' Arusha Technical College ATC') ?>" target="_blank" rel="noopener"><?= htmlspecialchars($row['description']) ?></a>
                        <small><i class="fa-regular fa-calendar"></i>Posted on: <?= $row['post_on'] ?></small>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </section>

        <!--Recent announcements-->
        <section class="card-box" id="announcements">
            <h3 class="section-title">Recent Announcements</h3>
            <?php if(isset($announcementsResult)): ?>
            <ul class="list-announcements">
                <li>
                    <span class="badge-new">NEW</span>
                    <a href="register.php">JOINING INSTRUCTIONS FOR BACHELOR DEGREE STUDENTS ACADEMIC YEAR 2026/2027</a>
                    <div class="meta-info">
                        <span><i class="fa-regular fa-clock"></i>July 13, 2026</span>
                        <a href="register.php" class="download-link"><i class="fa-solid fa-arrow-right"></i>Admissions</a>
                    </div>
                </li>
                <?php foreach($announcementsResult as $row): ?>
                    <li>
                    <span class="badge-new">NEW</span>
                    <a href="#announcements"><?= htmlspecialchars($row['title']) ?></a>
                    <div class="meta-info">
                        <span><i class="fa-regular fa-clock"></i><?= $row['announced_on']; ?></span>
                        <a href="contact.php" class="download-link"><i class="fa-solid fa-envelope"></i>Ask admissions</a>
                    </li>
                    <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </section>

        <!--ATC DOC CENTER-->
        <section class="card-box" id="documents">
            <h3 class="section-title">ATC Document Center</h3>
            <ul class="list-documents">
                <li><i class="fa-regular fa-file-word pdf-icon"></i><a href="documents/6a9e7014624636.04289287.docx" download>Graduate Tracer Study Report, June 2026</a></li>
                <li><i class="fa-regular fa-file-lines pdf-icon"></i><a href="contact.php">MKATABA WA HUDUMA KWA MTEJA - request copy</a></li>
                <li><i class="fa-regular fa-file-lines pdf-icon"></i><a href="contact.php">Fee structure - request latest copy</a></li>
            </ul>
        </section>
        </section>
        <!--CTA BANNER-->
        <section class="cta-banner">
            <h3>Are You Interested in joining Arusha Tchnical College></h3>
            <p>The college is accredited by Nacte to run and grant awards in technical and engineering programs.</p>
            <a href="register.php" class="cta-btn">APPLY NOW</a>
        </section>
    </main>

    <!-- FOOTER SECTION -->
     <footer class="container-fluid footer">
        <div class="row">
            <div class="col-md-2">
            <div class="footer-logo">
                <img src="./pictures/atc logo.png" alt="ATC Crest" class="col-md-12">
                <p><em>Skills make the difference</em></p>
            </div>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-3 footer-block">
                <h4>CONTACT US</h4>
                <p>Junction Of Moshi - Arusha and Nairobi Roads</p>
                <p>P.O.BOX 296, Arusha - Tanzania</p>
                <p><strong>Phone:</strong>+255 27 297 0056</p>
                <p><strong>Email:</strong>rector@atc.ac.tz</p>        
            </div>

            <div class="col-md-3 footer-block">
                <h4>USEFUL LINKS</h4>
                <ul>
                    <li><a href="https://www.moe.go.tz/" target="_blank" rel="noopener">Ministry of Education</a></li>
                    <li><a href="https://www.tcu.go.tz/" target="_blank" rel="noopener">Tanzania Commission for Universities</a></li>
                    <li><a href="https://www.heslb.go.tz/" target="_blank" rel="noopener">Higher Education Students' Loans Board</a></li>
                </ul>
            </div>

            <div class="col-md-3 footer-block">
                <h4>VISITORs counter</h4>
                <p>Today: 4985</p>
                <p>This Month: 77485</p>
                <p>Total Visit: 2130108</p>
            </div>

            <div class="bt-5 footer-bottom">
                <p>This website is developed and maintained by <strong>ISAAC ISACK</strong></p>
                <p>&copy; Copyright. All Rights Reserved</p>
            </div>
        </div>
     </footer>

     <!--Back to top button -->
     <button class="scroll-top-btn" id="scrollTopBtn"><i class="fa-solid fa-arrow-up"></i></button>

     <script src="script.js"></script>
</body>
</html>
