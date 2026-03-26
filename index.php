<?php
// === Dossiers ===
$heroDir = 'img_h/'; // Hero : images + vidéos MP4
$galleryDir = 'img/'; // Galerie : seulement images
$promoDir = 'img_promo/'; // Promo : images seulement
// === HERO : Récupération aléatoire (image OU vidéo mp4) ===
$heroFiles = glob($heroDir . '*.{jpg,jpeg,png,webp,mp4}', GLOB_BRACE);
if (!empty($heroFiles)) {
    $heroFile = $heroFiles[array_rand($heroFiles)];
    $heroExt = strtolower(pathinfo($heroFile, PATHINFO_EXTENSION));
    $isHeroVideo = $heroExt === 'mp4';
} else {
    $heroFile = 'https://via.placeholder.com/1920x1080/222/fff?text=Hero+ASE+Events';
    $isHeroVideo = false;
}
// === PROMO : Récupération aléatoire d'une image (si dossier non vide) ===
$promoImages = glob($promoDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);
$promoImage = null;
if (!empty($promoImages)) {
    $promoImage = $promoImages[array_rand($promoImages)];
}
// === GALERIE : Seulement les images, avec aléatoire ===
$galleryImages = glob($galleryDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);
if (!empty($galleryImages)) {
    shuffle($galleryImages); // Mélange aléatoire des images
} else {
    $galleryImages = [];
}
// === Groupement des images pour le carousel (correction pour les stacked à 1 image) ===
$slides = [];
$landscapeBuffer = [];
for ($i = 0; $i < count($galleryImages); $i++) {
    $img = $galleryImages[$i];
    $size = getimagesize($img);
    if ($size === false) continue;
    list($width, $height) = $size;
  
    if ($width > $height) { // Landscape
        $landscapeBuffer[] = $img;
        if (count($landscapeBuffer) == 2 || $i == count($galleryImages) - 1) {
            $type = (count($landscapeBuffer) == 2) ? 'stacked' : 'single';
            $slides[] = ['type' => $type, 'images' => $landscapeBuffer];
            $landscapeBuffer = [];
        }
    } else { // Portrait
        if (!empty($landscapeBuffer)) {
            $slides[] = ['type' => 'stacked', 'images' => $landscapeBuffer];
            $landscapeBuffer = [];
        }
        $slides[] = ['type' => 'single', 'images' => [$img]];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ASE Events : DJ mariage haut de gamme et professionnel depuis plus de 20 ans à Sartrouville (78). Déplacements dans toute la France, avec focus sur les départements 95, 92, 78, 60, 76 et 27. Animation événementielle sur-mesure par Julien, Tony et l'équipe ASE Events. Contactez-nous pour un devis gratuit.">
    <meta name="keywords" content="DJ mariage haut de gamme, DJ professionnel, animation mariage, DJ Sartrouville, DJ Yvelines 78, DJ Val-d'Oise 95, DJ Hauts-de-Seine 92, DJ Oise 60, DJ Seine-Maritime 76, DJ Eure 27, animation événementielle France">
    <title>ASE Events • DJ Mariage Haut de Gamme & Animation Événementielle Professionnelle</title>
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
        /* NAV */
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
        .logo {
            height: auto;
            max-height: 60px;
            max-width: 220px;
            width: auto;
        }
        .nav-links {
            display: flex;
            gap: 2.5rem;
            font-weight: 400;
            letter-spacing: 1px;
        }
        .nav-links a {
            color: var(--text-secondary);
        }
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
        /* HERO (support images + vidéos) */
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
        /* Overlay gradient (toujours présent) */
        .hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7));
            z-index: 1;
        }
        /* Fond image ou vidéo */
        .hero-bg, .hero-video {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
        }
        .hero-bg {
            background-size: cover;
            background-position: center;
        }
        .hero-video {
            object-fit: cover;
        }
        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2; /* Au-dessus de tout */
        }
        .hero-logo {
            height: auto;
            max-height: 200px;
            max-width: 400px;
            margin-bottom: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }
        .hero-content h1 {
            font-size: clamp(3.5rem, 9vw, 7rem);
            margin-bottom: 1.5rem;
            letter-spacing: 8px;
            font-weight: 300;
            text-transform: uppercase;
        }
        .hero-content p {
            font-size: 1.5rem;
            margin-bottom: 2.5rem;
            opacity: 0.8;
            font-weight: 300;
            max-width: 800px;
        }
        .btn {
            background: transparent;
            color: var(--text-primary);
            padding: 16px 45px;
            border: 1px solid var(--accent);
            border-radius: 50px;
            font-weight: 400;
            display: inline-block;
            margin: 0 15px;
            transition: all 0.4s ease;
        }
        .btn:hover {
            background: var(--accent);
            border-color: var(--accent);
            transform: translateY(-3px);
        }
        /* PROMO IMAGE (adaptée pour conserver le ratio et s'intégrer au design) */
        .promo {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 8%; /* Aligné avec les autres sections */
        }
        .promo img {
            width: 100%;
            height: auto;
            display: block;
        }
        /* SECTIONS */
        section {
            padding: 150px 8%;
            max-width: 1400px;
            margin: 0 auto;
        }
        h2 {
            font-size: 2.8rem;
            text-align: center;
            margin-bottom: 70px;
            color: var(--text-primary);
            position: relative;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-family: 'Playfair Display', serif;
        }
        h2:after {
            content: '';
            width: 100px;
            height: 1px;
            background: var(--accent);
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
        }
        /* ABOUT & SERVICES */
        .about-text, .services-grid {
            max-width: 900px;
            margin: 0 auto;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 50px;
        }
        .service-card {
            background: var(--bg-secondary);
            padding: 50px 35px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            text-align: center;
            transition: transform 0.4s ease;
        }
        .service-card:hover {
            transform: scale(1.05) translateY(-8px);
        }
        /* GALLERY CAROUSEL */
        .gallery-wrapper {
            position: relative;
            max-width: 100%;
            overflow: hidden;
        }
        .gallery-carousel {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            gap: 20px;
            padding-bottom: 25px;
            scrollbar-width: thin;
            scroll-padding-left: 20px;
        }
        .gallery-carousel::-webkit-scrollbar {
            height: 6px;
        }
        .gallery-carousel::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }
        .gallery-item {
            flex: 0 0 auto;
            width: 85%;
            max-width: 650px;
            scroll-snap-align: center;
            scroll-snap-stop: always;
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
            aspect-ratio: 3/4;
            display: flex;
            flex-direction: column;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }
        .gallery-item.stacked img {
            height: 50%;
        }
        /* Correction pour stacked avec UNE seule image */
        .gallery-item.stacked.single-img img {
            height: 100% !important;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.6);
            color: var(--text-primary);
            border: none;
            padding: 12px 24px;
            cursor: pointer;
            z-index: 10;
            font-size: 1.6rem;
            border-radius: 50%;
            transition: background 0.3s ease;
        }
        .carousel-btn:hover {
            background: var(--accent);
        }
        .carousel-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        .prev-btn { left: 15px; }
        .next-btn { right: 15px; }
        /* VIDEO */
        .video-container {
            max-width: 850px;
            margin: 50px auto 0;
            aspect-ratio: 16/9;
        }
        .video-container iframe {
            width: 100%;
            height: 100%;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
        }
        /* BADGE MARIAGES.NET */
        .badge-mariages {
            text-align: center;
            margin: 50px 0;
        }
        /* CONTACT */
        form {
            max-width: 750px;
            margin: 0 auto;
            background: var(--bg-secondary);
            padding: 60px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        input, textarea {
            width: 100%;
            padding: 16px;
            margin-bottom: 25px;
            border: 1px solid #333;
            border-radius: 8px;
            font-size: 1rem;
            background: #222;
            color: var(--text-primary);
        }
        textarea { min-height: 180px; resize: vertical; }
        button {
            background: var(--accent);
            color: var(--text-primary);
            padding: 16px 55px;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.4s ease;
        }
        button:hover { background: #e62a4a; transform: translateY(-3px); }
        /* FOOTER */
        footer {
            background: var(--bg-primary);
            color: var(--text-secondary);
            text-align: center;
            padding: 60px 20px;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        .footer-logo {
            max-height: 40px;
            margin: 15px auto;
            opacity: 0.9;
        }
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }
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
            .nav-links.active {
                display: flex;
            }
            section { padding: 80px 5%; }
            .logo { max-height: 40px; max-width: 150px; }
            .hero-logo { max-height: 100px; max-width: 200px; }
            .gallery-item { width: 90%; aspect-ratio: 3/4; }
            .hero { height: 80vh; } /* Ajustement pour mobile */
            .promo { padding: 0 5%; }
        }
        @media (max-width: 480px) {
            .logo { max-height: 30px; max-width: 120px; }
            .hero-logo { max-height: 80px; max-width: 160px; }
        }
    </style>
</head>
<body>
<!-- NAV (identique sur les 3 pages) -->
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
    <!-- HERO (image OU vidéo) -->
    <section class="hero" id="home">
        <?php if ($isHeroVideo): ?>
            <video class="hero-video" autoplay loop muted playsinline>
                <source src="<?php echo $heroFile; ?>" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo.
            </video>
        <?php else: ?>
            <div class="hero-bg" style="background-image: url('<?php echo $heroFile; ?>');"></div>
        <?php endif; ?>
        <div class="hero-content">
            <img src="logook.png" alt="ASE Events Logo - DJ Mariage Professionnel depuis plus de 20 ans" class="hero-logo">
            <h1>ASE EVENTS</h1>
            <p>DJ Mariage Haut de Gamme & Animation Événementielle</p>
            <p style="font-size:1.2rem; margin-bottom:2.5rem;">Votre DJ mariage professionnel depuis plus de 20 ans à Sartrouville (78) et partout en France</p>
            <a href="#prestations" class="btn">Voir nos prestations</a>
<a href="packs.php" class="btn">Découvrir les packs</a>
<a href="photobooth.php" class="btn">Corner PhotoBooth</a>
            <a href="#contact" class="btn">Demander un devis</a>
        </div>
    </section>
    <!-- PROMO IMAGE (si dossier non vide, avec redimensionnement conservant le ratio) -->
    <?php if ($promoImage): ?>
        <div class="promo">
            <a href="https://le-salon-du-mariage.fr/" target="_blank">
                <img src="<?php echo $promoImage; ?>" alt="Promotion ASE Events" loading="lazy">
            </a>
        </div>
    <?php endif; ?>
    <!-- QUI SOMMES-NOUS -->
    <section id="about">
        <h2>Qui sommes-nous ? DJ Mariage Haut de Gamme et Professionnel</h2>
        <div class="about-text">
            <p style="font-size:1.15rem; text-align:justify; max-width:900px; margin:0 auto 20px;">
                Chez <strong>ASE Events</strong>, nous sommes des <strong>DJ de mariage haut de gamme et professionnels</strong> depuis plus de 20 ans. Notre équipe, composée de Julien, Tony et toute l'équipe ASE Events, est passionnée par la musique et l'animation événementielle. Notre programmation musicale est généraliste et s'adapte parfaitement à vos invités pour créer une ambiance inoubliable. Notre leitmotiv : la musique se suffit à elle-même, sélectionnée avec soin pour vos événements.
            </p>
            <p style="font-size:1.15rem; text-align:justify; max-width:900px; margin:0 auto 20px;">
                Notre siège est basé à <strong>Sartrouville (78, Yvelines)</strong>, au 42 rue d'Estienne d'Orves, 78500 Sartrouville. Nous nous déplaçons dans toute la France pour vos mariages et événements, avec un axe principal sur les départements 95 (Val-d'Oise), 92 (Hauts-de-Seine), 78 (Yvelines), 60 (Oise), 76 (Seine-Maritime) et 27 (Eure). Que ce soit pour un mariage intime ou une grande célébration, nos DJ pros haut de gamme assurent une prestation sur-mesure.
            </p>
            <p style="font-size:1.15rem; text-align:justify; max-width:900px; margin:0 auto;">
                Contactez-nous via notre site <a href="https://ase-events.fr">ase-events.fr</a>, par email à info@ase-events.fr ou t.roussel@ase-events.fr, ou par téléphone au 01 47 66 93 93 ou au 07 66 29 02 90. Nous recommandons des prestataires de qualité partageant notre philosophie : professionnels passionnés et humains.
            </p>
        </div>
    </section>
    <!-- PRESTATIONS -->
    <section id="prestations">
        <h2>Nos Prestations DJ Mariage et Événementiel Haut de Gamme</h2>
        <div class="services-grid">
            <div class="service-card">
                <h3>Événements professionnels</h3>
                <p>Organisation de lancements de produits, spectacles, shows, soirées d’entreprise, séminaires, conférences, salons, repas de fin d’année, vœux, team building, karaoké. Solutions clé en main : organisation, animation, techniques avec matériel de qualité pour personnaliser vos lieux. En tant que DJ professionnel haut de gamme, nous assurons une animation événementielle impeccable dans les départements 78, 95, 92 et au-delà.</p>
            </div>
            <div class="service-card">
                <h3>Événements privés</h3>
                <p>Mariages, anniversaires ; animation musicale pour ambiancer vos moments intimes, avec adaptation musicale, matériel haut de gamme et garantie de qualité sans coupures techniques. Spécialistes DJ mariage pro depuis plus de 20 ans, nous intervenons à Sartrouville (78) et dans toute la France, avec focus sur 76 et 27 en Normandie.</p>
            </div>
        </div>
    </section>
    <!-- GALERIE avec carrousel -->
    <section id="gallery">
        <h2>En images : Nos Animations DJ Mariage Haut de Gamme</h2>
        <div class="gallery-wrapper">
            <div class="gallery-carousel" id="carousel">
                <?php foreach ($slides as $slide):
                    $itemClass = $slide['type'];
                    if ($slide['type'] === 'stacked' && count($slide['images']) === 1) {
                        $itemClass .= ' single-img';
                    }
                ?>
                    <div class="gallery-item <?php echo $itemClass; ?>">
                        <?php foreach ($slide['images'] as $img): ?>
                            <img src="<?php echo $img; ?>" alt="Photo animation DJ mariage haut de gamme ASE Events Sartrouville" loading="lazy">
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($galleryImages)): ?>
                    <p style="text-align:center; color:#777; width:100%;">Aucune photo pour le moment</p>
                <?php endif; ?>
            </div>
            <button class="carousel-btn prev-btn" onclick="scrollCarousel(-1)">&#10094;</button>
            <button class="carousel-btn next-btn" onclick="scrollCarousel(1)">&#10095;</button>
        </div>
        <!-- Vidéo promo 2026 -->
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/-d7F2jn5Cmc" title=" PUB MARIAGE 2026 ASE Events - DJ mariage haut de gamme" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
        </div>
        </div>
        <!-- Vidéo promo 2025 -->
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/wsyc9LGlK90" title="Vidéo promo 2025 ASE Events - DJ mariage haut de gamme" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
        </div>
        <!-- Vidéo mariage -->
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/XakpgZSryeI" title="Vidéo d'un mariage animé par ASE Events - DJ professionnel haut de gamme" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
        </div>
        <!-- BADGE MARIAGES.NET -->
        <div class="badge-mariages">
            <script src="https://cdn1.mariages.net/_js/wp-rated.js?v=4"></script>
            <div id="wp-rated">
                <a target="_blank" rel="nofollow" href="https://www.mariages.net/musique-mariage/ase-technololgie--e348016" title="Recommandé sur Mariages.net">
                    <img alt="Recommandé sur Mariages.net" id="wp-rated-img" src="https://cdn1.mariages.net/assets/img/badges/rated/badge-rated-250.png"/>
                </a>
            </div>
            <script>wpShowRatedv2('348016');</script>
        </div>
        <!-- AVIS MARIAGES.NET -->
        <div class="badge-mariages">
            <script src="https://cdn1.mariages.net/js/wp-widget.js?symfnw-FR48-1-20260312-002-0_www_m_"></script>
            <div id="wp-widget-reviews">
                <div id="wp-widget-preview">
                    Lire <a href="https://www.mariages.net/musique-mariage/ase-events--e348016/avis" rel="nofollow" rel="nofollow">nos avis</a> à &nbsp;
                    <a href='https://www.mariages.net' rel="nofollow">
                        <img src="https://cdn1.mariages.net/assets/img/logos/gen_logoHeader.svg" height="20">
                    </a>
                </div>
            </div>
            <script>wpShowReviews(348016, "black");</script>
        </div>
        <!-- GOOGLE REVIEWS -->
        <div class="badge-mariages">
            <!-- Elfsight Google Reviews | Untitled Google Reviews -->
            <script src="https://elfsightcdn.com/platform.js" async></script>
            <div class="elfsight-app-0402bec3-5347-41d1-a5e7-643dec8509ec" data-elfsight-app-lazy></div>
        </div>
    </section>
    <!-- ZONE -->
    <section id="zone">
        <h2>Notre Zone d'Intervention pour DJ Mariage Professionnel</h2>
        <p style="text-align:justify; font-size:1.15rem; max-width:900px; margin:0 auto;">
            Nous intervenons principalement en Île-de-France et Normandie, mais nos DJ mariage haut de gamme se déplacent dans toute la France. Notre siège est à Sartrouville (78), avec un axe fort sur les départements 95 (Val-d'Oise), 92 (Hauts-de-Seine), 78 (Yvelines), 60 (Oise), 76 (Seine-Maritime) et 27 (Eure). Contactez Julien, Tony ou l'équipe ASE Events pour une animation événementielle pro adaptée à votre lieu.
        </p>
    </section>
    <!-- CONTACT -->
    <section id="contact">
        <h2>Besoin d'un Devis pour DJ Mariage Haut de Gamme ?</h2>
        <p style="text-align:center; font-size:1.15rem; margin-bottom:30px;">
            Contactez-nous pour des renseignements ou un devis personnalisé pour votre mariage ou événement. Notre équipe de DJ pro haut de gamme est à votre écoute depuis Sartrouville (78).
        </p>
        <form action="mailto:info@ase-events.fr?subject=demande d'information ASE Events" method="post" enctype="text/plain">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="email" name="email" placeholder="Votre email" required>
            <textarea name="message" placeholder="Votre message ou demande de devis pour DJ mariage ou animation événementielle" required></textarea>
            <button type="submit">Envoyer ma demande</button>
        </form>
        <div style="text-align:center; margin-top:30px;">
            <label for="contact-phone-sms">Nous contacter par téléphone ou SMS :</label>
            <a href="tel:0766290290" class="btn" style="margin-right:15px;">Appeler</a>
            <a href="sms:0766290290" class="btn">Envoyer SMS</a>
        </div>
    </section>
    <!-- FOOTER -->
    <footer>
        <p>ASE Events © <?= date('Y') ?> • DJ Mariage Haut de Gamme & Animation Événementielle Professionnelle depuis plus de 20 ans</p>
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
    // Menu mobile (identique sur les 3 pages)
    function toggleMenu() {
        document.getElementById('navLinks').classList.toggle('active');
    }
        // Carousel amélioré (correction pour alignement sur PC)
        function scrollCarousel(direction) {
            const carousel = document.getElementById('carousel');
            if (!carousel) return;
            const items = Array.from(carousel.querySelectorAll('.gallery-item'));
            if (items.length === 0) return;
            const scrollLeft = carousel.scrollLeft;
            const containerWidth = carousel.offsetWidth;
            // Trouver l'index courant (le premier item visible)
            let currentIndex = items.findIndex(item => {
                const itemLeft = item.offsetLeft;
                return itemLeft >= scrollLeft && itemLeft < scrollLeft + containerWidth;
            });
            if (currentIndex === -1) currentIndex = 0;
            let nextIndex = currentIndex + direction;
            if (nextIndex < 0) nextIndex = 0;
            if (nextIndex >= items.length) nextIndex = items.length - 1;
            if (nextIndex === currentIndex) return; // Déjà au bord
            const nextItem = items[nextIndex];
            const nextPosition = nextItem.offsetLeft - (containerWidth / 2 - nextItem.offsetWidth / 2);
            carousel.scrollTo({
                left: nextPosition,
                behavior: 'smooth'
            });
            setTimeout(updateButtons, 300);
        }
        // Gestion des boutons (désactivés aux extrémités)
        function updateButtons() {
            const carousel = document.getElementById('carousel');
            if (!carousel) return;
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            if (!prevBtn || !nextBtn) return;
            prevBtn.disabled = carousel.scrollLeft <= 10;
            nextBtn.disabled = carousel.scrollLeft + carousel.offsetWidth >= carousel.scrollWidth - 10;
        }
        // Init au chargement
        window.addEventListener('load', () => {
            const carousel = document.getElementById('carousel');
            if (carousel) {
                carousel.addEventListener('scroll', updateButtons);
                updateButtons(); // Premier appel
            }
        });
    </script>
</body>
</html>