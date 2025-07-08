<?php
require_once("../includes/fonctions.php");

$job_statistics = getJobStatistics();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques des emplois</title>
    <link href="../assets/style.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-4">
    <h2>Statistiques des emplois</h2>
    <a href="index.php" class="btn btn-secondary mb-3">🏠</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Emploi</th>
                <th>Nombre d'♂️</th>
                <th>Nombre de ♀️</th>
                <th>💰Salaire moyen (Ar)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($job_statistics as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['male_count']) ?></td>
                <td><?= htmlspecialchars($row['female_count']) ?></td>
                <td><?= number_format($row['avg_salary'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>