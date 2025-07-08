<?php
require_once("../includes/connexion.php");
require_once("../includes/fonctions.php");

if (!isset($_GET['dept'])) {
    exit();
}

$dept_no = mysqli_real_escape_string($bdd, $_GET['dept']);
$employees = getEmployesParDepartement($dept_no);
$dept_name = !empty($employees) ? $employees[0]['dept_name'] : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Employés du département</title>
    <link href="../assets/style.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-4">
    <h2>Liste des employés du département <?= htmlspecialchars($dept_name) ?></h2>
    <a href="recherche.php" class="btn btn-primary mb-3">🔍</a>
    <a href="stats_emploi.php" class="btn btn-primary mb-3">👥</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>⚧️</th>
                <th>Date naissance🎂</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp): ?>
            <tr>
                <td>
                    <a href="fiche_employe.php?emp_no=<?= htmlspecialchars($emp['emp_no']) ?>&dept=<?= htmlspecialchars($dept_no) ?>">
                        <?= htmlspecialchars($emp['first_name'] . ' ' . $emp['last_name']) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($emp['gender']) ?></td>
                <td><?= htmlspecialchars($emp['birth_date']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">🏠</a>
</body>
</html>