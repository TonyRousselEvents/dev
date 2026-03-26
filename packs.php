<?php
// === Packs Wedding ASE - Configuration ===
$packs = [
    [
        'id' => 'essentiel',
        'title' => 'PACK ESSENTIEL',
        'price' => '1300€ TTC',
        'max' => '(100 pers max)',
        'video' => 'img_pack/PACK ESSENTIEL.mp4',
        'features' => [
            'DJ Open format pro',
            'Musique de 19h à 1h',
            'Sonorisation en salle (2t+2s) + sonorisation du vin d\'honneur (1 enceinte colonne)',
            '4 Micros HF qualité animateur',
            '12 éclairages de salle',
            '4 Effets led robotisés',
            '1 machine à brouillard',
            'DJ booth mur led (2m x 1m) - diffusion de vos photos et vidéos',
            'Heure(s) supplémentaire(s) possibles (50€/h)'
        ],
        'img_dir' => 'img_pack/img_essentiel/'
    ],
    [
        'id' => 'eclat',
        'title' => 'PACK ÉCLAT',
        'price' => '2100€ TTC',
        'max' => '(200 pers max)',
        'video' => 'img_pack/PACK ECLAT.mp4',
        'features' => [
            'DJ Open format pro + 1 Technicien',
            'Musique de 19h à 3h',
            'Sonorisation en salle (2t+2s) + sonorisation du vin d\'honneur (2 enceintes colonnes)',
            '4 Micros HF qualité chanteur',
            '24 éclairages de salle',
            '6 tubes led 360°',
            '4 Effets led robotisés',
            '1 machine à brouillard',
            'DJ booth mur led (2 m x 1m) + fond mur led (3m x 2m)',
            '1 Option offerte (2 Geyser ou 2 jet d\'étincelle)',
            'Heure(s) supplémentaire(s) possibles (100€/h)'
        ],
        'img_dir' => 'img_pack/img_eclat/'
    ],
    [
        'id' => 'signature',
        'title' => 'PACK SIGNATURE',
        'price' => '3100€ TTC',
        'max' => '(300 pers max)',
        'video' => 'img_pack/PACK SIGNATURE.mp4',
        'features' => [
            'DJ Open format pro + 2 Techniciens',
            'Musique de 17h à 4h',
            'Sonorisation en salle (2t+2s) + sonorisation du vin d\'honneur (2 enceintes colonnes)',
            '4 Micros HF qualité chanteur',
            '24 éclairages de salle + 12 tubes led 360°',
            '8 Effets led robotisés',
            '1 machine à brouillard',
            'DJ booth mur led (2 m x 1m) + fond mur led (3m x 2m)',
            '2 Totem mur led (0,5m x 2m)',
            '1 Option offerte (4 Geyser ou 4 jet d\'étincelle)',
            '1 Photobooth offert + 50% de réduction sur le Corner',
            'Heure(s) supplémentaire(s) possibles (150€/h)'
        ],
        'img_dir' => 'img_pack/img_signature/'
    ]
];

// === HERO ===
$heroDir = 'img_h/';
$heroFiles = glob($heroDir . '*.{jpg,jpeg,png,webp,mp4}', GLOB_BRACE);
if (!empty($heroFiles)) {
    $heroFile = $heroFiles[array_rand($heroFiles)];
    $heroExt = strtolower(pathinfo($heroFile, PATHINFO_EXTENSION));
    $isHeroVideo = $heroExt === 'mp4';
} else {
    $heroFile = 'https://via.placeholder.com/1920x1080/222/fff?text=PACKS+WEDDING+ASE';
    $isHeroVideo = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez les 3 packs Wedding ASE Events : ESSENTIEL, ÉCLAT et SIGNATURE.">
    <title>ASE Events • Packs Wedding DJ Mariage Haut de Gamme</title>
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
        }
        * { box-sizing: border-box; margin:0; padding:0; }
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.7;
            color: var(--text-primary);
            background: radial-gradient(circle, #1a1a1a, #0d0d0d);
        }
        a { text-decoration: none; color: inherit; transition: color 0.3s ease; }

        /* NAV + HERO + PACKS + GALERIE (identique à avant) */
        nav { position: fixed; top: 0; left: 0; right: 0; background: rgba(13,13,13,0.95); z-index: 1000; padding: 1.2rem 5%; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 20px rgba(0,0,0,0.6); }
        .nav-content { display: flex; justify-content: space-between; align-items: center; width: 100%; max-width: 1400px; }
        .logo { height: auto; max-height: 60px; max-width: 220px; }
        .nav-links { display: flex; gap: 2.5rem; font-weight: 400; letter-spacing: 1px; }
        .nav-links a { color: var(--text-secondary); }
        .nav-links a:hover { color: var(--accent); }
        .hamburger { display: none; flex-direction: column; cursor: pointer; }
        .hamburger span { height: 2px; width: 28px; background: var(--text-primary); margin-bottom: 6px; border-radius: 5px; }

        .hero { height: 100vh; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; text-align: center; color: var(--text-primary); }
        .hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)); z-index: 1; }
        .hero-bg, .hero-video { position: absolute; inset: 0; width: 100%; height: 100%; z-index: -1; }
        .hero-bg { background-size: cover; background-position: center; }
        .hero-video { object-fit: cover; }
        .hero-content { position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; }
        .hero-logo { height: auto; max-height: 200px; max-width: 400px; margin-bottom: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.8); }
        .hero-content h1 { font-size: clamp(3.5rem, 9vw, 7rem); margin-bottom: 1.5rem; letter-spacing: 8px; font-weight: 300; text-transform: uppercase; }
        .hero-content p { font-size: 1.5rem; margin-bottom: 2.5rem; opacity: 0.8; max-width: 800px; }
        .btn {
            background: transparent;
            color: var(--text-primary);
            padding: 16px 45px;
            border: 1px solid var(--accent);
            border-radius: 50px;
            font-weight: 400;
            margin: 0 15px;
            transition: all 0.4s ease;
        }
        .btn:hover { background: var(--accent); border-color: var(--accent); transform: translateY(-3px); }

        #packs { padding: 150px 8% 100px; max-width: 1400px; margin: 0 auto; }
        .pack { margin-bottom: 140px; }
        .pack-header { text-align: center; margin-bottom: 30px; }
        .pack-header h3 { font-size: 2.6rem; font-family: 'Playfair Display', serif; color: var(--accent); margin-bottom: 8px; }
        .pack-header .price { font-size: 1.8rem; font-weight: 700; color: #fff; }
        .pack-content { display: flex; flex-wrap: wrap; gap: 60px; align-items: flex-start; justify-content: center; }

        .pack-video {
            position: relative;
            flex: 1 1 340px;
            max-width: 340px;
        }
        .pack-video video {
            width: 100%;
            aspect-ratio: 9 / 16;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            display: block;
        }

        /* BOUTON PLEIN ÉCRAN (visible uniquement sur téléphone) */
        .mobile-fullscreen-btn {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: rgba(200,16,46,0.9);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 1rem;
            cursor: pointer;
            z-index: 30;
            display: none;
        }
        @media (max-width: 768px) {
            .mobile-fullscreen-btn { display: block; }
        }
        .mobile-fullscreen-btn:hover { background: var(--accent); transform: scale(1.1); }

        .pack-details { flex: 1 1 520px; min-width: 300px; }
        .pack-details ul { list-style: none; margin-bottom: 40px; }
        .pack-details ul li { padding: 12px 0; border-bottom: 1px solid #333; font-size: 1.15rem; position: relative; padding-left: 30px; }
        .pack-details ul li:before { content: '✓'; color: var(--accent); position: absolute; left: 0; font-weight: bold; }

        /* GALERIE AVEC BOUTONS */
        .gallery-wrapper { position: relative; margin-top: 60px; padding: 20px 0; }
        .pack-gallery-scroll {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
            scroll-snap-type: x mandatory;
            scrollbar-width: thin;
            align-items: flex-start;
        }
        .pack-gallery-scroll::-webkit-scrollbar { height: 6px; }
        .pack-gallery-scroll::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 10px; }
        .pack-gallery-scroll img {
            height: 340px;
            width: auto;
            flex-shrink: 0;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.4);
            scroll-snap-align: center;
            transition: transform 0.4s ease;
            max-width: 520px;
        }
        .pack-gallery-scroll img:hover { transform: scale(1.05); }

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
        .gallery-btn:hover { background: var(--accent); transform: translateY(-50%) scale(1.1); }
        .gallery-btn.prev { left: -15px; }
        .gallery-btn.next { right: -15px; }

        /* CONTACT + FOOTER (identique à la version précédente) */
        #contact { padding: 100px 8%; max-width: 1400px; margin: 0 auto; background: var(--bg-primary); }
        #contact h2 { text-align: center; margin-bottom: 20px; }
        #contact p { text-align: center; font-size: 1.15rem; max-width: 800px; margin: 0 auto 40px; }
        form { max-width: 850px; margin: 0 auto; background: var(--bg-secondary); padding: 50px; border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
        .form-row { display: flex; gap: 20px; margin-bottom: 25px; }
        .form-row input { flex: 1; }
        input, textarea { width: 100%; padding: 16px 20px; background: #222 !important; color: #f4f4f4 !important; border: 1px solid #444; border-radius: 10px; font-size: 1.05rem; }
        textarea { min-height: 160px; resize: vertical; }
        button { background: var(--accent); color: white; padding: 16px 50px; border: none; border-radius: 50px; font-size: 1.1rem; cursor: pointer; width: 100%; margin-top: 10px; }
        button:hover { background: #e62a4a; transform: translateY(-3px); }
        .contact-buttons { display: flex; gap: 20px; justify-content: center; margin-top: 40px; }
        .contact-buttons a { padding: 14px 40px; border: 2px solid var(--accent); border-radius: 50px; font-weight: 500; transition: all 0.3s; }
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
        .footer-logo { max-height: 48px; margin: 25px auto 15px; opacity: 0.85; }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .pack-video { flex-basis: 300px; max-width: 300px; }
        }
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            .nav-links { display: none; flex-direction: column; gap: 1.5rem; position: absolute; top: 100%; left: 0; background: rgba(13,13,13,0.95); padding: 25px; width: 100%; text-align: center; }
            .nav-links.active { display: flex; }
            #packs { padding: 100px 5% 60px; }
            .pack-header h3 { font-size: 2.2rem; }
            .pack-gallery-scroll img { height: 280px; }
            .form-row { flex-direction: column; gap: 15px; }
            .pack-video { flex-basis: 250px; max-width: 250px; }
            .pack-details { min-width: 250px; }
            .pack-details ul li { font-size: 1rem; padding-left: 25px; }
            .pack-content { gap: 30px; }
        }
        @media (max-width: 550px) {
            .pack-content { flex-direction: column; align-items: center; }
            .pack-video { max-width: 300px; flex-basis: auto; }
            .pack-details { min-width: auto; }
            .pack-gallery-scroll img { height: 240px; }
        }
        @media (max-width: 480px) {
            .pack-video { max-width: 240px; }
        }
        /* ==================== BOUTON PLEIN ÉCRAN DISCRET ==================== */
        .mobile-fullscreen-btn {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(200, 16, 46, 0.55);
            color: #fff;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 1.35rem;
            line-height: 36px;
            text-align: center;
            cursor: pointer;
            z-index: 30;
            display: none;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0,0,0,0.4);
        }

        .mobile-fullscreen-btn:hover {
            background: rgba(200, 16, 46, 0.85);
            transform: scale(1.12);
        }

        @media (max-width: 768px) {
            .mobile-fullscreen-btn { display: block; }
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
            <h1>PACKS WEDDING</h1>
            <p>Choisissez votre niveau d’animation DJ mariage haut de gamme</p>
            <a href="#packs" class="btn">Découvrir les packs</a>
            <a href="#contact" class="btn">Demander un devis</a>
        </div>
    </section>

    <section id="packs">
        <h2 style="text-align:center; margin-bottom:80px;">Les Packs Wedding ASE</h2>
        
        <?php foreach ($packs as $pack): 
            $images = glob($pack['img_dir'] . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);
            shuffle($images);
        ?>
        <div class="pack">
            <div class="pack-header">
                <h3><?php echo $pack['title']; ?></h3>
                <div class="price"><?php echo $pack['price']; ?> <?php echo $pack['max']; ?></div>
            </div>

            <div class="pack-content">
                <div class="pack-video">
                    <video autoplay loop muted playsinline>
                        <source src="<?php echo $pack['video']; ?>" type="video/mp4">
                    </video>
                    <button class="mobile-fullscreen-btn" onclick="makeVideoFullscreen(this)" title="Plein écran">⛶</button>
                </div>

                <div class="pack-details">
                    <ul>
                        <?php foreach ($pack['features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#contact" class="btn">Je veux ce pack → Demander un devis</a>
                </div>
            </div>

            <?php if (!empty($images)): ?>
            <div class="gallery-wrapper">
                <div class="pack-gallery-scroll" id="gallery-<?php echo $pack['id']; ?>">
                    <?php foreach ($images as $img): ?>
                        <img src="<?php echo $img; ?>" alt="Galerie <?php echo $pack['title']; ?> ASE Events" loading="lazy">
                    <?php endforeach; ?>
                </div>
                <button class="gallery-btn prev" onclick="scrollGallery('<?php echo $pack['id']; ?>', -1)">‹</button>
                <button class="gallery-btn next" onclick="scrollGallery('<?php echo $pack['id']; ?>', 1)">›</button>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </section>

    <!-- CONTACT + FOOTER (identique) -->
    <section id="contact">
        <h2>Besoin d’un devis pour votre Pack Wedding ?</h2>
        <p>Contactez-nous pour un devis personnalisé. Notre équipe vous répond sous 24h.</p>
        <form action="mailto:info@ase-events.fr?subject=Demande de devis PACK WEDDING" method="post" enctype="text/plain">
            <div class="form-row">
                <input type="text" name="nom" placeholder="Votre nom" required>
                <input type="email" name="email" placeholder="Votre email" required>
            </div>
            <input type="text" name="pack" placeholder="Je souhaite le pack ESSENTIEL / ÉCLAT / SIGNATURE" required>
            <textarea name="message" placeholder="Date du mariage, nombre d'invités, commentaires..." required></textarea>
            <button type="submit">Envoyer ma demande de devis</button>
        </form>
        <div class="contact-buttons">
            <a href="tel:0766290290">Appeler</a>
            <a href="sms:0766290290">SMS</a>
        </div>
    </section>

<!-- FOOTER (identique partout) -->
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

        // === BOUTON PLEIN ÉCRAN CORRIGÉ (fonctionne sur iPhone + Android) ===
        function makeVideoFullscreen(btn) {
            const video = btn.parentElement.querySelector('video');
            if (!video) return;

            if (video.paused) video.play();

            // Méthodes modernes + iOS Safari
            if (video.requestFullscreen) {
                video.requestFullscreen().catch(() => {});
            } else if (video.webkitRequestFullscreen) {
                video.webkitRequestFullscreen();
            } else if (video.webkitEnterFullscreen) {
                video.webkitEnterFullscreen();
            } else if (video.mozRequestFullScreen) {
                video.mozRequestFullScreen();
            } else if (video.msRequestFullscreen) {
                video.msRequestFullscreen();
            }
        }

        // === BOUTONS GALERIE (déjà OK) ===
        function scrollGallery(packId, direction) {
            const container = document.getElementById('gallery-' + packId);
            if (!container) return;
            const scrollAmount = container.clientWidth * 0.85;
            container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
        }
    </script>
</body>
</html>