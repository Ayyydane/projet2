<?php
require_once("../includes/fonctions.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche Employes</title>
    <link href="../assets/style.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-4">
    <h2>Recherche d'employes</h2>
    <form method="GET" action="resultats_recherche.php" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="nom" class="form-control" placeholder="Nom employe" value="<?= htmlspecialchars($_GET['nom'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <select name="dept" class="form-control">
                <option value="">Tous les departements</option>
                <?php
                $departements = getDepartementsAvecManager();
                foreach ($departements as $dept): ?>
                    <option value="<?= htmlspecialchars($dept['dept_no']) ?>" <?= isset($_GET['dept']) && $_GET['dept'] == $dept['dept_no'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dept['dept_no']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="age_min" class="form-control" placeholder="Âge min" value="<?= htmlspecialchars($_GET['age_min'] ?? '') ?>">
        </div>
        <div class="col-md-2">
            <input type="number" name="age_max" class="form-control" placeholder="Âge max" value="<?= htmlspecialchars($_GET['age_max'] ?? '') ?>">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">🔍</button>
        </div>
    </form>
    <a href="index.php" class="btn btn-secondary">🏠</a>
    <a href="stats_emploi.php" class="btn btn-primary mb-3">👥</a>
</body>
</html>