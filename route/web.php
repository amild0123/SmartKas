<?php


$page = isset($_GET['page']) ? $_GET['page'] : 'home';
if ($page === 'home') {
    include 'page/landingPage.php';
} elseif ($page === 'input') {
    include 'page/PageInput.php';
} elseif ($page === 'recap') {
    include 'page/recap.php';
} elseif($page == 'Login') {
    include 'page/Login.php';
} elseif($page == 'about') {
    include 'page/about.php';
}
?>

