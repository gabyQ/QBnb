<!DOCTYPE html>
<html>
<head>
    <title>QBnb</title>
    <meta charset="utf-8" />

    <link rel="shortcut icon" href="../../public_html/img/logo.png">
    <!-- CSS -->
    <link href="../../public_html/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../public_html/css/font-awesome.min.css" rel="stylesheet" media="screen">

    <!-- SCRIPTS -->
    <script type="text/javascript" src="../../public_html/js/bootstrap.min.js"></script>
</head>

<body>
<div id="preloader">
    <div id="status"></div>
</div>
<div id="ajaxloader-container" style="display: none;">
    <div id="ajaxloader" style="display: none;"></div>
</div>
<div class="container-fluid content-container">
    <div class="row">
        <div class="hidden-xs" id="nav-container">
            <div class="navbar">
                <?php
                // load up your config file
                require_once("../config.php");

                require_once(TEMPLATES_PATH . "/publicNavbar.php");
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="content-pane" class="k-pane">
            <div class="frame">
                <div id="main-content-area">

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
