<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover Arusha Technical College, a practical, competence-based institution for engineering, technology, vocational education and applied research.">
    <title>About ATC | Arusha Technical College</title>
    <style>
        :root {
            --ink: #10233f;
            --ink-deep: #07172c;
            --blue: #164e8e;
            --sky: #dceef4;
            --gold: #e6ad3d;
            --coral: #e46d4d;
            --paper: #f7f9f6;
            --muted: #66768a;
            --line: #dbe4e8;
            --white: #ffffff;
            --shadow: 0 24px 60px rgba(16, 35, 63, 0.14);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background: var(--paper);
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            line-height: 1.6;
        }
        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }
        button { font: inherit; }
        .site-header {
            position: absolute;
            z-index: 10;
            top: 0;
            right: 0;
            left: 0;
            color: var(--white);
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: min(1180px, calc(100% - 2.5rem));
            min-height: 86px;
            margin: auto;
        }
        .brand { display: flex; align-items: center; gap: 0.75rem; }
        .brand img { width: 48px; height: 48px; object-fit: contain; }
        .brand strong { display: block; font-size: 0.92rem; letter-spacing: 0.08em; }
        .brand span { display: block; color: #c8d8e2; font-size: 0.68rem; letter-spacing: 0.05em; }
        .nav-links { display: flex; align-items: center; gap: 1.7rem; font-size: 0.84rem; font-weight: 700; }
        .nav-links a { opacity: 0.85; transition: color 180ms ease, opacity 180ms ease; }
        .nav-links a:hover, .nav-links a:focus { color: var(--gold); opacity: 1; }
        .nav-cta { padding: 0.62rem 1rem; border: 1px solid rgba(255,255,255,0.45); border-radius: 999px; }
        .nav-toggle { display: none; border: 1px solid rgba(255,255,255,0.5); border-radius: 8px; padding: 0.45rem 0.65rem; color: var(--white); background: transparent; cursor: pointer; }
        .hero {
            position: relative;
            min-height: 700px;
            overflow: hidden;
            color: var(--white);
            background: var(--ink-deep);
        }
        .hero::before {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(7,23,44,0.94) 0%, rgba(7,23,44,0.72) 47%, rgba(7,23,44,0.16) 100%), url('pictures/pic1.jpg') center/cover;
            content: "";
        }
        .hero::after {
            position: absolute;
            right: -10rem;
            bottom: -13rem;
            width: 36rem;
            height: 36rem;
            border: 1px solid rgba(230,173,61,0.5);
            border-radius: 50%;
            box-shadow: 0 0 0 40px rgba(230,173,61,0.06), 0 0 0 80px rgba(230,173,61,0.04);
            content: "";
        }
        .hero-inner { position: relative; z-index: 1; width: min(1180px, calc(100% - 2.5rem)); margin: auto; padding: 12rem 0 7rem; }
        .eyebrow { display: inline-flex; align-items: center; gap: 0.55rem; color: var(--gold); font-size: 0.74rem; font-weight: 800; letter-spacing: 0.18em; text-transform: uppercase; }
        .eyebrow::before { width: 2.5rem; height: 2px; background: var(--gold); content: ""; }
        h1, h2, h3, p { margin-top: 0; }
        h1 { max-width: 750px; margin: 1.1rem 0 1.3rem; font-family: Georgia, serif; font-size: clamp(3rem, 7vw, 6.1rem); font-weight: 500; line-height: 0.98; letter-spacing: -0.04em; }
        .hero-copy { max-width: 570px; color: #d8e4e8; font-size: 1.1rem; }
        .hero-actions { display: flex; flex-wrap: wrap; gap: 0.8rem; margin-top: 2.2rem; }
        .button { display: inline-flex; align-items: center; justify-content: center; min-height: 48px; padding: 0.7rem 1.2rem; border: 1px solid transparent; border-radius: 5px; font-size: 0.82rem; font-weight: 800; letter-spacing: 0.04em; transition: transform 180ms ease, background 180ms ease, border-color 180ms ease; }
        .button:hover, .button:focus { transform: translateY(-2px); }
        .button-primary { color: var(--ink-deep); background: var(--gold); }
        .button-secondary { border-color: rgba(255,255,255,0.45); color: var(--white); background: rgba(255,255,255,0.06); }
        .hero-note { display: flex; align-items: center; gap: 0.7rem; margin-top: 3.4rem; color: #b9ccd2; font-size: 0.78rem; }
        .hero-note span { width: 34px; height: 1px; background: var(--coral); }
        .stats { position: relative; z-index: 2; margin-top: -58px; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); width: min(1040px, calc(100% - 2.5rem)); margin: auto; border-top: 4px solid var(--gold); background: var(--white); box-shadow: var(--shadow); }
        .stat { padding: 1.5rem 1.7rem; border-right: 1px solid var(--line); }
        .stat:last-child { border-right: 0; }
        .stat strong { display: block; color: var(--blue); font-family: Georgia, serif; font-size: 2.2rem; font-weight: 500; line-height: 1; }
        .stat span { display: block; margin-top: 0.45rem; color: var(--muted); font-size: 0.75rem; font-weight: 700; }
        .section { width: min(1180px, calc(100% - 2.5rem)); margin: auto; padding: 7rem 0; }
        .section-intro { display: grid; grid-template-columns: 0.85fr 1.15fr; gap: 5rem; align-items: end; margin-bottom: 3rem; }
        .section-label { color: var(--coral); font-size: 0.72rem; font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; }
        h2 { margin: 0.7rem 0 0; font-family: Georgia, serif; font-size: clamp(2.2rem, 4vw, 4rem); font-weight: 500; line-height: 1.04; letter-spacing: -0.03em; }
        .section-intro p { margin: 0; color: var(--muted); font-size: 1.05rem; }
        .story-grid { display: grid; grid-template-columns: 1.08fr 0.92fr; gap: 3rem; align-items: center; }
        .story-image { position: relative; min-height: 470px; overflow: hidden; background: var(--sky); }
        .story-image img { width: 100%; height: 100%; min-height: 470px; object-fit: cover; }
        .image-tag { position: absolute; right: 1.2rem; bottom: 1.2rem; max-width: 220px; padding: 1rem; color: var(--white); background: rgba(7,23,44,0.9); font-size: 0.78rem; }
        .story-copy h3 { margin-bottom: 1rem; font-family: Georgia, serif; font-size: 2rem; font-weight: 500; }
        .story-copy p { color: var(--muted); }
        .signature { display: flex; align-items: center; gap: 0.9rem; margin-top: 2rem; }
        .signature img { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; }
        .signature strong { display: block; font-size: 0.83rem; }
        .signature span { color: var(--muted); font-size: 0.73rem; }
        .programmes { background: var(--ink); color: var(--white); }
        .programmes .section { padding-bottom: 6.4rem; }
        .programmes .section-intro p { color: #aebfca; }
        .programme-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1px; background: #38516a; }
        .programme { min-height: 240px; padding: 1.6rem; background: var(--ink); transition: background 180ms ease, transform 180ms ease; }
        .programme:hover { position: relative; z-index: 1; background: #193a61; transform: translateY(-5px); }
        .programme-number { color: var(--gold); font-family: Georgia, serif; font-size: 1.5rem; }
        .programme h3 { margin: 2.3rem 0 0.6rem; font-size: 1rem; }
        .programme p { margin: 0; color: #afc0c9; font-size: 0.84rem; }
        .campuses { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.2rem; }
        .campus { position: relative; min-height: 330px; overflow: hidden; color: var(--white); background: var(--ink-deep); }
        .campus img { width: 100%; height: 100%; min-height: 330px; object-fit: cover; opacity: 0.65; transition: transform 400ms ease; }
        .campus:hover img { transform: scale(1.05); }
        .campus::after { position: absolute; inset: 35% 0 0; background: linear-gradient(transparent, rgba(7,23,44,0.94)); content: ""; }
        .campus-content { position: absolute; z-index: 1; right: 1.4rem; bottom: 1.3rem; left: 1.4rem; }
        .campus-content h3 { margin-bottom: 0.3rem; font-family: Georgia, serif; font-size: 1.55rem; font-weight: 500; }
        .campus-content p { margin: 0; color: #d3e0e5; font-size: 0.8rem; }
        .portal { background: var(--sky); }
        .portal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3.5rem; align-items: center; }
        .portal-copy p { max-width: 490px; color: var(--muted); }
        .portal-list { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; margin: 1.7rem 0 2rem; padding: 0; list-style: none; }
        .portal-list li { padding: 0.8rem 0.9rem; border-left: 3px solid var(--coral); background: rgba(255,255,255,0.66); font-size: 0.8rem; font-weight: 700; }
        .portal-image { padding: 0.75rem; background: var(--white); box-shadow: var(--shadow); transform: rotate(2deg); }
        .portal-image img { width: 100%; height: 320px; object-fit: cover; }
        .closing { position: relative; overflow: hidden; padding: 6rem 1.5rem; color: var(--white); text-align: center; background: var(--coral); }
        .closing::before { position: absolute; top: -7rem; left: 8%; width: 22rem; height: 22rem; border: 1px solid rgba(255,255,255,0.3); border-radius: 50%; content: ""; }
        .closing > * { position: relative; z-index: 1; }
        .closing h2 { max-width: 650px; margin: 0.7rem auto 1rem; }
        .closing p { max-width: 550px; margin: auto auto 1.7rem; color: #ffe7df; }
        .closing .button-primary { color: var(--coral); background: var(--white); }
        footer { padding: 2rem 1.25rem; color: #adbdc8; background: var(--ink-deep); font-size: 0.75rem; }
        .footer-inner { display: flex; align-items: center; justify-content: space-between; width: min(1180px, 100%); margin: auto; }
        .footer-brand { display: flex; align-items: center; gap: 0.7rem; color: var(--white); font-weight: 700; }
        .footer-brand img { width: 30px; height: 30px; object-fit: contain; }
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity 600ms ease, transform 600ms ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        @media (max-width: 850px) {
            .nav-links { display: none; position: absolute; top: 75px; right: 1.25rem; left: 1.25rem; flex-direction: column; align-items: stretch; gap: 0; padding: 0.8rem; border: 1px solid rgba(255,255,255,0.2); background: var(--ink-deep); }
            .nav-links.open { display: flex; }
            .nav-links a { padding: 0.75rem; }
            .nav-toggle { display: block; }
            .hero { min-height: 650px; }
            .section-intro, .story-grid, .portal-grid { grid-template-columns: 1fr; gap: 2rem; }
            .programme-grid { grid-template-columns: repeat(2, 1fr); }
            .campuses { grid-template-columns: 1fr; }
            .campus, .campus img { min-height: 250px; }
        }
        @media (max-width: 560px) {
            .nav, .hero-inner, .section { width: min(100% - 1.5rem, 1180px); }
            .brand span { display: none; }
            .hero-inner { padding-top: 10rem; }
            h1 { font-size: clamp(2.7rem, 14vw, 4.2rem); }
            .stats-grid { grid-template-columns: 1fr 1fr; width: calc(100% - 1.5rem); }
            .stat { padding: 1.1rem; }
            .stat:nth-child(2) { border-right: 0; }
            .stat:nth-child(-n+2) { border-bottom: 1px solid var(--line); }
            .stat strong { font-size: 1.75rem; }
            .story-image, .story-image img { min-height: 330px; }
            .programme-grid { grid-template-columns: 1fr; }
            .portal-list { grid-template-columns: 1fr; }
            .footer-inner { align-items: flex-start; flex-direction: column; gap: 0.7rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { transition-duration: 0.01ms !important; animation-duration: 0.01ms !important; }
            .reveal { opacity: 1; transform: none; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <nav class="nav" aria-label="Primary navigation">
            <a class="brand" href="index.php">
                <img src="pictures/atc logo.png" alt="ATC crest">
                <span><strong>ARUSHA TECHNICAL COLLEGE</strong><span>Skills make the difference</span></span>
            </a>
            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="navLinks">MENU</button>
            <div class="nav-links" id="navLinks">
                <a href="index.php">Home</a>
                <a href="about.php" aria-current="page">About</a>
                <a href="login.php">ATC-SMS</a>
                <a href="contact.php" class="nav-cta">Contact us</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-inner">
                <div class="eyebrow">About Arusha Technical College</div>
                <h1>Built for people who make things work.</h1>
                <p class="hero-copy">ATC is a practical, competence-based college where technical knowledge becomes useful skill, confident work, and sustainable progress for Tanzania and the East African region.</p>
                <div class="hero-actions">
                    <a href="index.php#documents" class="button button-primary">Explore ATC resources</a>
                    <a href="contact.php" class="button button-secondary">Talk to the college</a>
                </div>
                <div class="hero-note"><span></span>Central Arusha · Tanzania · East African Community</div>
            </div>
        </section>

        <section class="stats" aria-label="ATC at a glance">
            <div class="stats-grid">
                <div class="stat"><strong data-count="40">0+</strong><span>Years of growth and training</span></div>
                <div class="stat"><strong data-count="27">0</strong><span>TET programmes</span></div>
                <div class="stat"><strong data-count="23">0</strong><span>VET programmes</span></div>
                <div class="stat"><strong data-count="3">0</strong><span>Learning locations</span></div>
            </div>
        </section>

        <section class="section reveal">
            <div class="section-intro">
                <div><div class="section-label">The ATC story</div><h2>Learning that meets the real world.</h2></div>
                <p>Located in the heart of Arusha, ATC brings together engineering, technology, vocational education, applied research, and student support in one forward-looking learning community.</p>
            </div>
            <div class="story-grid">
                <div class="story-image"><img src="pictures/pic3.jpg" alt="Students and learning at Arusha Technical College"><div class="image-tag">A place to learn, test ideas, and build a future.</div></div>
                <div class="story-copy">
                    <h3>Practical knowledge. Serious purpose.</h3>
                    <p>Arusha Technical College is designed for learners who want more than theory. Its hands-on, competence-based approach develops the knowledge, skills, and attitudes needed to enter engineering and service industries as employees, entrepreneurs, and employers.</p>
                    <p>From diploma and bachelor programmes to artisan training through VETA, ATC connects classroom learning with the needs of industry, agriculture, energy, and the wider economy.</p>
                    <div class="signature"><img src="pictures/rector.jpg" alt="Professor Musa N. Chacha"><div><strong>Prof. Musa N. Chacha</strong><span>Rector, Arusha Technical College</span></div></div>
                </div>
            </div>
        </section>

        <section class="programmes">
            <div class="section reveal">
                <div class="section-intro">
                    <div><div class="section-label">What we develop</div><h2>Skills with a destination.</h2></div>
                    <p>ATC programmes are shaped around capability: the ability to solve problems, work safely, adapt to technology, and contribute meaningfully from day one.</p>
                </div>
                <div class="programme-grid">
                    <article class="programme"><div class="programme-number">01</div><h3>Engineering & technology</h3><p>Competence-led study for the technical and engineering industries.</p></article>
                    <article class="programme"><div class="programme-number">02</div><h3>Diploma pathways</h3><p>18 diploma programmes supporting focused professional progression.</p></article>
                    <article class="programme"><div class="programme-number">03</div><h3>Bachelor programmes</h3><p>Nine degree pathways for deeper expertise and leadership.</p></article>
                    <article class="programme"><div class="programme-number">04</div><h3>VETA artisan training</h3><p>Practical NVA levels 1-3 and 23 vocational training programmes.</p></article>
                </div>
            </div>
        </section>

        <section class="section reveal">
            <div class="section-intro">
                <div><div class="section-label">Beyond one campus</div><h2>Learning across a living region.</h2></div>
                <p>Arusha gives ATC a distinctive setting: a commercial city, a gateway to East Africa, and a place where energy, agriculture, tourism, and technology meet.</p>
            </div>
            <div class="campuses">
                <article class="campus"><img src="pictures/pic5.jpg" alt="Arusha Technical College main campus"><div class="campus-content"><h3>Arusha campus</h3><p>At the junction of the Moshi-Arusha and Nairobi roads, in the centre of Arusha City.</p></div></article>
                <article class="campus"><img src="pictures/pic8.jpg" alt="Technical training at ATC"><div class="campus-content"><h3>Kikuletwa campus</h3><p>In Hai District, focused on renewable-energy training and power production.</p></div></article>
                <article class="campus"><img src="pictures/pic11.jpg" alt="Applied learning and agriculture"><div class="campus-content"><h3>Oljoro training area</h3><p>Supporting irrigated-agriculture training in Arusha District.</p></div></article>
            </div>
        </section>

        <section class="portal">
            <div class="section portal-grid reveal">
                <div class="portal-copy">
                    <div class="section-label">Student life, supported</div>
                    <h2>Progress should feel organised.</h2>
                    <p>The ATC-SMS student service centre brings everyday academic tasks into one place, giving students a clearer way to manage their college journey and get help when it matters.</p>
                    <ul class="portal-list">
                        <li>Semester registration</li>
                        <li>Examination results</li>
                        <li>IPT support</li>
                        <li>Certificates and letters</li>
                    </ul>
                    <a href="login.php" class="button button-primary">Open ATC-SMS</a>
                </div>
                <div class="portal-image"><img src="pictures/atc-dashboard.png" alt="ATC student service dashboard"></div>
            </div>
        </section>

        <section class="closing">
            <div class="section-label">Your next chapter starts here</div>
            <h2>Come ready to learn. Leave ready to contribute.</h2>
            <p>Explore the college, find the right programme, and connect with the people who can help you move forward.</p>
            <a href="contact.php" class="button button-primary">Contact ATC</a>
        </section>
    </main>

    <footer>
        <div class="footer-inner">
            <a class="footer-brand" href="index.php"><img src="pictures/atc logo.png" alt="ATC crest">Arusha Technical College</a>
            <span>P.O. BOX 296, Arusha, Tanzania · rector@atc.ac.tz · +255 27 297 0056</span>
        </div>
    </footer>

    <script>
        const navToggle = document.querySelector('.nav-toggle');
        const navLinks = document.querySelector('#navLinks');
        navToggle.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('open');
            navToggle.setAttribute('aria-expanded', String(isOpen));
        });
        navLinks.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
            navLinks.classList.remove('open');
            navToggle.setAttribute('aria-expanded', 'false');
        }));

        const revealItems = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.14 });
        revealItems.forEach((item) => revealObserver.observe(item));

        const stats = document.querySelector('.stats');
        const counters = document.querySelectorAll('[data-count]');
        let counted = false;
        const countObserver = new IntersectionObserver((entries, observer) => {
            if (entries[0].isIntersecting && !counted) {
                counted = true;
                counters.forEach((counter) => {
                    const target = Number(counter.dataset.count);
                    let current = 0;
                    const step = Math.max(1, Math.ceil(target / 24));
                    const timer = setInterval(() => {
                        current = Math.min(current + step, target);
                        counter.textContent = current + (target === 3 ? '' : '+');
                        if (current === target) clearInterval(timer);
                    }, 35);
                });
                observer.disconnect();
            }
        }, { threshold: 0.35 });
        countObserver.observe(stats);
    </script>
</body>
</html>
