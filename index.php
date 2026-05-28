<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'component/head.php'; ?>
<body>
    <?php include 'component/nav.php'; ?>

    <?php include 'route/web.php'; ?>
</body>
    