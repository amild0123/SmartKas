<?php


$page = isset($_GET['page']) ? $_GET['page'] : 'home';
if ($page === 'home') {
    include 'page/about.php';
} elseif ($page === 'input') {
    include 'page/PageInput.php';
} elseif ($page === 'recap') {
    include 'page/rekap.php';
} elseif($page == 'Login') {
    include 'Login.php';
} elseif($page == 'logOut') {
    include 'route/logOut.php';
} else {
    echo "<h1>404 Not Found</h1>";
}
?>

