<?php
/**
 * convert_webp.php — Script de conversion images en WebP
 * Usage : accéder à https://dev.ase-events.fr/convert_webp.php depuis le navigateur
 * IMPORTANT : supprimer ce fichier après utilisation !
 */

// Sécurité basique : token dans l'URL (?token=ase2026)
$token = $_GET['token'] ?? '';
if ($token !== 'ase2026') {
    die('<h2>Accès refusé. Ajoutez ?token=ase2026 à l\'URL.</h2>');
}

// Vérifier que GD est disponible avec support WebP
if (!function_exists('imagewebp')) {
    die('<h2>Erreur : PHP GD avec support WebP non disponible sur ce serveur.</h2>');
}

$dirs = ['img', 'img_h', 'img_pack', 'img_photobooth', 'img_promo'];
$quality = 82; // 0-100, 82 = bon compromis qualité/poids
$results = [];
$totalSaved = 0;
$converted = 0;
$skipped = 0;
$errors = 0;

foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;

    $files = glob($dir . '/*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
    foreach ($files as $file) {
        $info = pathinfo($file);
        $webpPath = $dir . '/' . $info['filename'] . '.webp';

        // Déjà converti ? Passer
        if (file_exists($webpPath)) {
            $skipped++;
            continue;
        }

        $ext = strtolower($info['extension']);
        $srcSize = filesize($file);

        try {
            // Charger l'image source
            if ($ext === 'png') {
                $img = imagecreatefrompng($file);
                // Préserver la transparence PNG
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
            } else {
                $img = imagecreatefromjpeg($file);
            }

            if (!$img) {
                $results[] = "❌ Impossible de charger : $file";
                $errors++;
                continue;
            }

            // Convertir en WebP
            imagewebp($img, $webpPath, $quality);
            imagedestroy($img);

            $dstSize = file_exists($webpPath) ? filesize($webpPath) : 0;
            $saved = $srcSize - $dstSize;
            $pct = $srcSize > 0 ? round(($saved / $srcSize) * 100) : 0;
            $totalSaved += $saved;
            $converted++;

            $results[] = "✅ " . basename($file) . " → " . basename($webpPath)
                . " (" . round($srcSize/1024) . "KB → " . round($dstSize/1024) . "KB, -$pct%)";

        } catch (Exception $e) {
            $results[] = "❌ Erreur sur $file : " . $e->getMessage();
            $errors++;
        }
    }
}

$totalSavedKB = round($totalSaved / 1024);
$totalSavedMB = round($totalSaved / 1048576, 2);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Conversion WebP — ASE Events</title>
    <style>
        body { font-family: monospace; background: #111; color: #eee; padding: 30px; }
        h1 { color: #c8102e; }
        .ok { color: #4caf50; }
        .err { color: #f44336; }
        .summary { background: #222; padding: 20px; border-radius: 8px; margin: 20px 0; font-size: 1.1rem; }
        .warn { background: #c8102e; color: white; padding: 15px; border-radius: 8px; margin-top: 30px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>🔄 Conversion WebP — ASE Events</h1>
    <div class="summary">
        ✅ <strong><?= $converted ?></strong> images converties |
        ⏭️ <strong><?= $skipped ?></strong> déjà existantes |
        ❌ <strong><?= $errors ?></strong> erreurs |
        💾 Économie totale : <strong><?= $totalSavedKB ?>KB (<?= $totalSavedMB ?>MB)</strong>
    </div>
    <?php foreach ($results as $r): ?>
        <div class="<?= str_starts_with($r, '✅') ? 'ok' : 'err' ?>"><?= htmlspecialchars($r) ?></div>
    <?php endforeach; ?>
    <div class="warn">
        ⚠️ IMPORTANT : Supprimez ce fichier (convert_webp.php) du serveur après utilisation !
    </div>
</body>
</html>
