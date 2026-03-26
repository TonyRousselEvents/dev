<?php
// === CORNER PHOTOBOOTH ASE - Configuration ===
$mainPrice = '650€ HT';
$noteTTC = '(TTC pour les particuliers – HT pour les pros)';

// === HERO : images/vidéos depuis le dossier img_photobooth (top level seulement) ===
$heroDir = 'img_photobooth/';
$heroFiles = glob($heroDir . '*.{jpg,jpeg,png,webp,mp4}', GLOB_BRACE);
if (!empty($heroFiles)) {
    $heroFile = $heroFiles[array_rand($heroFiles)];
    $heroExt = strtolower(pathinfo($heroFile, PATHINFO_EXTENSION));
    $isHeroVideo = $heroExt === 'mp4';
} else {
    $heroFile = 'https://via.placeholder.com/1920x1080/222/fff?text=CORNER+PHOTOBOOTH+ASE';
    $isHeroVideo = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Corner Photobooth ASE Events – Borne selfie professionnelle avec accessoires, tirages HD, photos numériques illimitées. 650€ HT. Installation complète pour mariages, événements pro et privés.">
    <title>ASE Events • Corner PhotoBooth Borne Selfie & Accessoires</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <style>
        :root {
            --bg-primary: #0d0d0d;
            --bg-secondary: #1a1a1a;
            --text-primary: #f4f4f4;
            --text-secondary: #b0b0b0;
            --accent: #c8102e;
            --shadow: rgba(0,0,0,0.6);
        }
        * { box-sizing: border-box; margin:0; padding:0; }
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.7;
            color: var(--text-primary);
            background: radial-gradient(circle, #1a1a1a, #0d0d0d);
        }
        a { text-decoration: none; color: inherit; transition: color 0.3s ease; }
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            background: rgba(13,13,13,0.95);
            color: var(--text-primary);
            z-index: 1000;
            padding: 1.2rem 5%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 20px var(--shadow);
        }
        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1400px;
        }
        .logo { height: auto; max-height: 60px; max-width: 220px; }
        .nav-links {
            display: flex;
            gap: 2.5rem;
            font-weight: 400;
            letter-spacing: 1px;
        }
        .nav-links a { color: var(--text-secondary); }
        .nav-links a:hover { color: var(--accent); }
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }
        .hamburger span {
            height: 2px;
            width: 28px;
            background: var(--text-primary);
            margin-bottom: 6px;
            border-radius: 5px;
        }
        .hero {
            height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--text-primary);
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7));
            z-index: 1;
        }
        .hero-bg, .hero-video {
            position: absolute;
            inset: 0;
            width: 100%; height: 100%;
            z-index: -1;
        }
        .hero-bg { background-size: cover; background-position: center; }
        .hero-video { object-fit: cover; }
        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .hero-logo {
            height: auto;
            max-height: 180px;
            max-width: 380px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }
        .hero-content h1 {
            font-size: clamp(3rem, 8vw, 6rem);
            margin-bottom: 1rem;
            letter-spacing: 6px;
            font-weight: 300;
            text-transform: uppercase;
            font-family: 'Playfair Display', serif;
        }
        .hero-content p {
            font-size: 1.6rem;
            opacity: 0.9;
            max-width: 700px;
        }
        .btn {
            background: transparent;
            color: var(--text-primary);
            padding: 16px 45px;
            border: 1px solid var(--accent);
            border-radius: 50px;
            font-weight: 400;
            margin: 15px;
            transition: all 0.4s ease;
        }
        .btn:hover {
            background: var(--accent);
            border-color: var(--accent);
            transform: translateY(-3px);
        }
        #photobooth {
            padding: 140px 8% 100px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .photobooth-header {
            text-align: center;
            margin-bottom: 60px;
        }
        .photobooth-header h2 {
            font-size: 3.2rem;
            font-family: 'Playfair Display', serif;
            color: var(--accent);
            margin-bottom: 10px;
        }
        .photobooth-header .subtitle {
            font-size: 1.4rem;
            opacity: 0.8;
        }
        .price-big {
            font-size: 2.6rem;
            font-weight: 700;
            color: #fff;
            margin: 30px 0;
        }
        .note-ttc {
            font-size: 1.1rem;
            color: var(--accent);
            font-weight: 500;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            margin-bottom: 80px;
        }
        .features-list {
            background: var(--bg-secondary);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }
        .features-list ul {
            list-style: none;
        }
        .features-list li {
            padding: 14px 0;
            border-bottom: 1px solid #333;
            font-size: 1.15rem;
            position: relative;
            padding-left: 32px;
        }
        .features-list li:before {
            content: '✓';
            color: var(--accent);
            position: absolute;
            left: 0;
            font-size: 1.3rem;
        }
        .options {
            background: var(--bg-secondary);
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 80px;
        }
        .options h3 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--accent);
        }
        .options ul {
            list-style: none;
        }
        .options li {
            padding: 12px 0;
            border-bottom: 1px solid #333;
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
        }
        .gallery-wrapper {
            position: relative;
            margin-top: 40px;
        }
        .pack-gallery-scroll {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
            scroll-snap-type: x mandatory;
            scrollbar-width: thin;
            align-items: flex-start;
        }
        .pack-gallery-scroll::-webkit-scrollbar {
            height: 6px;
        }
        .pack-gallery-scroll::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }
        .pack-gallery-scroll img {
            height: 340px;
            width: auto;
            flex-shrink: 0;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.4);
            scroll-snap-align: center;
            transition: transform 0.4s ease;
            max-width: 520px;
            object-fit: contain;
        }
        .pack-gallery-scroll img:hover {
            transform: scale(1.05);
        }
        .gallery-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.75);
            color: white;
            border: none;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            font-size: 1.9rem;
            cursor: pointer;
            z-index: 15;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .gallery-btn:hover {
            background: var(--accent);
            transform: translateY(-50%) scale(1.1);
        }
        .gallery-btn.prev { left: -15px; }
        .gallery-btn.next { right: -15px; }
        .slogan {
            text-align: center;
            font-size: 2.8rem;
            font-family: 'Playfair Display', serif;
            color: var(--accent);
            margin: 80px 0 60px;
            line-height: 1.3;
        }
        #contact {
            padding: 100px 8%;
            max-width: 1400px;
            margin: 0 auto;
            background: var(--bg-primary);
        }
        #contact h2 { text-align: center; margin-bottom: 20px; }
        #contact p { text-align: center; font-size: 1.15rem; max-width: 800px; margin: 0 auto 40px; }
        form {
            max-width: 850px;
            margin: 0 auto;
            background: var(--bg-secondary);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .form-row { display: flex; gap: 20px; margin-bottom: 25px; }
        .form-row input { flex: 1; }
        input, textarea {
            width: 100%;
            padding: 16px 20px;
            background: #222 !important;
            color: #f4f4f4 !important;
            border: 1px solid #444;
            border-radius: 10px;
            font-size: 1.05rem;
        }
        textarea { min-height: 160px; resize: vertical; }
        button {
            background: var(--accent);
            color: white;
            padding: 16px 50px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        button:hover { background: #e62a4a; transform: translateY(-3px); }
        .contact-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
        }
        .contact-buttons a {
            padding: 14px 40px;
            border: 2px solid var(--accent);
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .contact-buttons a:hover { background: var(--accent); color: white; }
        footer {
            background: #0a0a0a;
            color: #999;
            text-align: center;
            padding: 80px 20px 40px;
            font-size: 0.95rem;
            line-height: 1.8;
            margin-top: 80px;
        }
        .footer-logo {
            max-height: 48px;
            margin: 25px auto 15px;
            opacity: 0.85;
        }
        @media (max-width: 992px) {
            .features-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            .nav-links {
                display: none;
                flex-direction: column;
                gap: 1.5rem;
                position: absolute;
                top: 100%;
                left: 0;
                background: rgba(13,13,13,0.95);
                padding: 25px;
                width: 100%;
                text-align: center;
            }
            .nav-links.active { display: flex; }
            #photobooth { padding: 100px 5% 60px; }
            .pack-gallery-scroll img { height: 280px; }
            .form-row { flex-direction: column; }
        }
        @media (max-width: 480px) {
            .pack-gallery-scroll img { height: 240px; }
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <div class="nav-content">
        <a href="index.php#home"><img src="logook.png" alt="ASE Events" class="logo"></a>
        <div class="nav-links" id="navLinks">
            <a href="index.php#home">Accueil</a>
            <a href="index.php#about">Qui sommes-nous ?</a>
            <a href="packs.php#packs">Nos Packs Wedding</a>
            <a href="photobooth.php#photobooth">Corner PhotoBooth</a>
            <a href="index.php#prestations">Prestations</a>
            <a href="index.php#gallery">Galerie</a>
            <a href="index.php#zone">Zone d'intervention</a>
            <a href="index.php#contact">Contact</a>
        </div>
        <div class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="home">
    <?php if ($isHeroVideo): ?>
        <video class="hero-video" autoplay loop muted playsinline>
            <source src="<?php echo $heroFile; ?>" type="video/mp4">
        </video>
    <?php else: ?>
        <div class="hero-bg" style="background-image: url('<?php echo $heroFile; ?>');"></div>
    <?php endif; ?>
    <div class="hero-content">
        <img src="logook.png" alt="ASE Events Logo" class="hero-logo">
        <h1>CORNER PHOTOBOOTH</h1>
        <p>Borne Selfie & Accessoires – Souvenirs inoubliables</p>
        <a href="#photobooth" class="btn">Découvrir l’offre</a>
        <a href="#contact" class="btn">Réserver</a>
    </div>
</section>

<!-- PHOTOBOOTH -->
<section id="photobooth">
    <div class="photobooth-header">
        <h2>CORNER PHOTOBOOTH</h2>
        <p class="subtitle">By ASE Events • Borne selfie professionnelle</p>
        <div class="price-big"><?php echo $mainPrice; ?></div>
        <p class="note-ttc"><?php echo $noteTTC; ?></p>
    </div>

    <div class="features-grid">
        <div class="features-list">
            <h3 style="margin-bottom:25px; color:var(--accent);">Ce qui est inclus dans le pack 650€ HT</h3>
            <ul>
                <li>Choix d’un cadre photo personnalisé (nom société + date)</li>
                <li>Installation complète de l’espace photo</li>
                <li>Tapis de sol + éléments de décoration + éclairage studio</li>
                <li>Réglages et test d’impression</li>
                <li>Table d’accessoires (chapeaux, lunettes, cadres en bois…)</li>
                <li>400 tirages photos HD 10×15 cm ou 800 bandelettes 15×5 cm</li>
                <li>Assistance physique en cas de bourrage papier</li>
                <li>Photos numériques illimitées</li>
                <li>Démontage et reprise du matériel</li>
                <li>Envoi des photos numériques au client</li>
            </ul>
        </div>

        <div class="options">
            <h3>Options & Suppléments</h3>
            <ul>
                <li>Toile de fond champêtre 3×2m <span style="color:var(--accent); font-weight:600;">+100€ HT</span></li>
                <li>Tapis rouge VIP 3m + potelets <span style="color:var(--accent); font-weight:600;">+100€ HT</span></li>
                <li>Composition avancée par graphiste <span style="color:var(--accent); font-weight:600;">+200€ HT</span></li>
                <li>Borne selfie seule (sans accessoires) <span style="color:var(--accent); font-weight:600;">400€ HT</span></li>
                <li>Recharge 800 impressions (15×5 cm) ou 400 (10×15 cm) <span style="color:var(--accent); font-weight:600;">+150€ HT</span></li>
            </ul>
            <p style="margin-top:30px; font-size:0.95rem; opacity:0.8; text-align:center;">La recharge entamée est facturée en totalité</p>
        </div>
    </div>

    <div class="slogan">
        Gardez des souvenirs inoubliables !
    </div>

    <!-- PREMIÈRE GALERIE – Photos -->
    <?php
    $galleryDir = 'img_photobooth/img_galerie/';
    $galleryImages = glob($galleryDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);
    shuffle($galleryImages);
    if (!empty($galleryImages)):
    ?>
    <div class="gallery-wrapper">
        <div class="pack-gallery-scroll" id="photobooth-gallery">
            <?php foreach ($galleryImages as $img): ?>
                <img src="<?php echo $img; ?>" alt="Corner Photobooth ASE Events" loading="lazy">
            <?php endforeach; ?>
        </div>
        <button class="gallery-btn prev" onclick="scrollGallery('photobooth-gallery', -1)">‹</button>
        <button class="gallery-btn next" onclick="scrollGallery('photobooth-gallery', 1)">›</button>
    </div>
    <?php endif; ?>

    <!-- DEUXIÈME GALERIE – GIFs -->
    <?php
    $gifDir = 'img_photobooth/img_gif/';
    $gifFiles = glob($gifDir . '*.{gif,GIF}', GLOB_BRACE);
    shuffle($gifFiles);
    if (!empty($gifFiles)):
    ?>
    <div class="gallery-wrapper" style="margin-top: 100px;">
        <h3 style="text-align:center; color:var(--accent); margin-bottom: 40px; font-size: 2.2rem; font-family:'Playfair Display', serif;">
            Moments en mouvement
        </h3>
        <div class="pack-gallery-scroll" id="photobooth-gif-gallery">
            <?php foreach ($gifFiles as $gif): ?>
                <img src="<?php echo $gif; ?>" alt="Animation Photobooth ASE Events" loading="lazy">
            <?php endforeach; ?>
        </div>
        <button class="gallery-btn prev" onclick="scrollGallery('photobooth-gif-gallery', -1)">‹</button>
        <button class="gallery-btn next" onclick="scrollGallery('photobooth-gif-gallery', 1)">›</button>
    </div>
    <?php endif; ?>

</section>

<!-- CONTACT -->
<section id="contact">
    <h2>Réserver votre Corner PhotoBooth</h2>
    <p>Contactez-nous pour un devis ou une réservation. Réponse sous 24h.</p>
    <form action="mailto:info@ase-events.fr?subject=Demande Corner PhotoBooth" method="post" enctype="text/plain">
        <div class="form-row">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="email" name="email" placeholder="Votre email" required>
        </div>
        <input type="text" name="event" placeholder="Type d'événement (mariage, soirée pro...)" required>
        <textarea name="message" placeholder="Date, nombre d'invités, options souhaitées..." required></textarea>
        <button type="submit">Envoyer ma demande</button>
    </form>
    <div class="contact-buttons">
        <a href="tel:0766290290">Appeler</a>
        <a href="sms:0766290290">SMS</a>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>ASE Events © <?= date('Y') ?> • DJ Mariage Haut de Gampe & Animation Événementielle Professionnelle depuis plus de 20 ans</p>
    <p>Tél : 01 47 66 93 93 • Portable : 07 66 29 02 90 • info@ase-events.fr • t.roussel@ase-events.fr</p>
    <p>42 rue d'Estienne d'Orves, 78500 Sartrouville (78, Yvelines)</p>
    <p>SIRET ASE Technologie : 920 977 618 00015 • Assuré MAAF Pro depuis plus de 15 ans sans incident</p>
    <p>ASE Events appartient au groupe ASE avec ASE Technologie</p>
    <a href="GED/assurance.pdf" target="_blank">
        <img src="https://www.capeb.fr/www/capeb/media/bas-rhin/image/MAAF%20PRO.jpg" alt="Assuré MAAF Pro" class="footer-logo">
    </a>
    <p style="margin-top:5px; font-size:0.85rem;">Attestation d'assurance téléchargeable en cliquant sur le logo MAAF PRO</p>
    <p style="margin-top:15px; font-size:0.85rem;">Votre DJ mariage pro en Île-de-France (95, 92, 78, 60) et Normandie (76, 27) – Déplacements toute France</p>
</footer>

<script>
    function toggleMenu() {
        document.getElementById('navLinks').classList.toggle('active');
    }

    // Fonction de scroll réutilisable pour les deux galeries
    function scrollGallery(galleryId, direction) {
        const container = document.getElementById(galleryId);
        if (!container) return;
        const scrollAmount = container.clientWidth * 0.85;
        container.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>

</body>
</html>