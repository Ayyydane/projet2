<?php
require_once("../includes/fonctions.php");

if (!isset($_GET['emp_no'])) {
    header("Location: index.php");
    exit();
}

$emp_no = mysqli_real_escape_string($bdd, $_GET['emp_no']);
$currentDept = getCurrentDepartement($emp_no);
$departements = getDepartementsAvecManager();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = changeDepartement(
        $emp_no,
        $_POST['new_dept'] ?? '',
        $_POST['from_date'] ?? '',
        $_POST['current_dept_no'] ?? '',
        $_POST['current_from_date'] ?? ''
    );
    $success = $result['success'];
    $error = $result['error'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changer de département</title>
    <link href="../assets/style.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-4">
    <h2>Changer de département</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <a href="fiche_employe.php?emp_no=<?= htmlspecialchars($emp_no) ?>&dept=<?= htmlspecialchars($_GET['dept'] ?? '') ?>" class="btn btn-primary mb-3">Retour à la fiche employé</a>
        <a href="index.php" class="btn btn-secondary mb-3">Retour à l'accueil</a>
    <?php else: ?>
        <?php if ($currentDept): ?>
            <p><strong>Departement actuel :</strong> <?= htmlspecialchars($currentDept['dept_name']) ?> (depuis <?= htmlspecialchars($currentDept['from_date']) ?>)</p>
        <?php else: ?>
            <p>Aucun département actuel assigné.</p>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="changer_dept.php?emp_no=<?= htmlspecialchars($emp_no) ?>&dept=<?= htmlspecialchars($_GET['dept'] ?? '') ?>" class="row g-3 mb-4">
            <input type="hidden" name="emp_no" value="<?= htmlspecialchars($emp_no) ?>">
            <input type="hidden" name="current_dept_no" value="<?= htmlspecialchars($currentDept['dept_no'] ?? '') ?>">
            <input type="hidden" name="current_from_date" value="<?= htmlspecialchars($currentDept['from_date'] ?? '') ?>">
            <div class="col-md-6">
                <label for="new_dept" class="form-label">Nouveau département</label>
                <select name="new_dept" id="new_dept" class="form-control" required>
                    <option value="">Sélectionner un département</option>
                    <?php foreach ($departements as $dept): ?>
                        <?php if ($dept['dept_no'] !== ($currentDept['dept_no'] ?? '')): ?>
                            <option value="<?= htmlspecialchars($dept['dept_no']) ?>">
                                <?= htmlspecialchars($dept['dept_name']) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="from_date" class="form-label">Date de début</label>
                <input type="date" name="from_date" id="from_date" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">✔️</button>
            </div>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">🏠</a>
        <a href="stats_emploi.php" class="btn btn-primary mb-3">👥</a>
        <a href="fiche_employe.php?emp_no=<?= htmlspecialchars($emp_no) ?>&dept=<?= htmlspecialchars($_GET['dept'] ?? '') ?>" class="btn btn-primary mt-3">↩️</a>
    <?php endif; ?>
</body>
</html>