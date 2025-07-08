<?php
session_start();
session_destroy();
header("Location: ../PAGES/index.php");
exit();
?>
