<?php


$page = isset($_GET['page']) ? $_GET['page'] : 'home';
if ($page === 'home') {
    include 'page/about.php';
} elseif ($page === 'input') {
    include 'page/PageInput.php';
} elseif ($page === 'recap') {
    include 'page/recap.php';
} 
?>