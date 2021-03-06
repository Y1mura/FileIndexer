<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', '1');

// If our do-setup file exist then force the user it's view into the installation index file
if (!file_exists("do-setup")) {
    header('Location: install/');

    exit();
}
else {
    $urlPath = str_replace("index.php", "", $_SERVER['REQUEST_URI']); // this path is needed

    $pathCount = substr_count($urlPath, '/') - 1;
    $relativePath = "./";
    for ($i=0; $i < $pathCount; $i++) {
        $relativePath = $relativePath."../";
    }
    $isGuest = False;
    if (isset($_SESSION['uid']) && $_SESSION['uid'] == "-1") {
        $isGuest = True;
    }
    require 'inc/user-info.php';

    require 'page/template/head.php';
    ?>
    <div id="whole-page-wrapper">
    <?php
    if (isset($_SESSION['uid'])) {
        require 'inc/functions.php'; // Needed to calculate data in nav
        require 'page/template/nav.php';
        require 'page/file-manager.php';
    }
    else {
        require 'page/login.php';
    }
    ?>
    </div>
    <?php
    require 'page/template/footer.php';
}
?>
