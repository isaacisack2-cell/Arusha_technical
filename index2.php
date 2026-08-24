<?php
try{
require "config.php";
$sql = $pdo->prepare("SELECT * FROM posts ORDER BY Id DESC limit 5");
$sql->execute();
$posts = $sql->fetchAll();


}catch(PDOException $e){
    $error = "Error occured ".$e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>www.atc.ac.tz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="welcome"><span id="hambergar_menu"></span>Welcome ATC <span id="options"></span></div>
    <div class="slider"><img src="./pictures/pic3.jpg" alt="ATC ENVIRONMENTS" id="atc_env"></div>

    <div id="rector_card">
        <img src="./pictures/picha.jpg" alt="RECTOR">
        <p>I'm pleased to introduce you to the Arusha Technical College (ATC). Choosing the right college is the major decission and it's importtant that You choose the one that's right for you. Our website indicates whats its like to be student ar Arusha Techinical COllege in the words of the people who know it best - Our students past and present and staff however, a website can only go so far and the best way to gain an insight into life at Arusha Technical College is to visit us and experience it for yourself. <br>Our college is located at the Central Bussiness District of Arusha City which has populated over two millions depending mainly on agriculture, commerce, trade and tourism for economic purposes. The city is also the headquarters of East African Community (EAC) and the doors to the world's great wildlife heritage, including Ngorongoro Crater, Serengeti and Lake Manayara national parks.... <span id="read_more">Read More</span><p id="more" style="display:none;">Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document... <span id="show_less">show_less</span></p>
        <hr width="30%" style="margin: 10px 0; height: 3px; color: navy; background-color: navy;">
        <span id="search_program">
            <h3>Search Programme</h3>
            <input type="search" name="search_programme" id="search_program_input" placeholder="-- Enter Programme Keyword --" class="search">
            <input type="submit" value="🔍 View Programme Details" name="search" class="search" id="search_program_btn">
        </span>
    </p>
    </div>

    <div id="card2">
        <hr width="30%" style="margin: 10px 0; height: 2px; color: navy; background-color: navy;">
        <h3>Recent Posts</h3>
        <div id="recent_posts">
            <?php if(isset($posts) && count($posts) > 0): ?>
            <table cellpadding="10" cellspacing="0" border="0">
                <?php foreach($posts as $post): ?>
                    <tr>
                        <td class="post_img_td"><img src="<?= $post['name']?>" alt="recent ATC post" class="post_img"></td>
                        <td><?= $post['description'] ?><br>Posted On: <?= $post['post_on'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
                <?php include "status_box.php"; ?>
        </div>
    </div>

    <div id="card3">
        <h1>Are you interesting in joining Arusha Technical College?</h1>
        <p style="color: #AAAAAA;">The College is accredited by the National Council for Technical Education (NACTE) to run and grant awards to successful candidates in technician and Engineering programs. Awards offered are Ordinary Diploma namely the National Technical Level (NTA) 4 – 6 and the prospective Bachelor of Engineering namely the National Technical Level (NTA) 7 – 8.</p>
        <hr style="color: #ffffff; margin:20px 0;">
        <div id="card3ii">
                <!--box 1-->
                <div class="box3ii">
                    <h2>ARUSHA TECHNICAL COLLEGE</h2>
                    <span id="atc_logo_2">
                        <img src="./pictures/atc logo.png" alt="ATC LOGO">
                    </span>
                    <h4>Skills Makes The Difference</h4>
                </div>

                <!--box 2-->
                <div class="box3ii">
                    <h2>CONTACT US</h2>
                    <p>
                        Junction Of Moshi-Arusha and Nairobi Roads
                        <br>
                        P.O.BOX 296
                        <br>
                        Arusha-TZ
                        <br>
                        Phone: +255 27 297 0056
                        <br>
                        Email: rector@atc.ac.tz
                    </p>
                </div>

                <!--box 3-->
                <div class="box3ii">
                    <h2>USEFUL LINKS</h2>
                    <ul>
                        <li>The National Council for Technical and Vacational Education and Training</li>
                        <li>Ministry of Education, Science and Technology</li>
                        <li>Tanzania Commission for Universities</li>
                        <li>Higher Education</li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>