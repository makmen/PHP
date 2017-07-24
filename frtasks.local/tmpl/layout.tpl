<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $head ?>
    </head>
    <body class="page">
        <div id="wrap">
            <div class="top-line">
                <div class="page-project">
                    <?php if ($project != '') : ?>
                        Проект: <span><?= $project ?></span>
                    <?php else: ?>
                        &nbsp;
                    <?php endif; ?>
                </div>
                <div class="page-auth">
                    <?= $auth ?>
                </div>
            </div>
            <div class="cb"></div>
            <div id="header">
                <a href="<?= Config::SERVER_NAME ?>"><img src="<?= Config::SERVER_NAME ?>/images/logo.png" /></a>
                <div id="nav">
                    <?= $menu ?>
                </div>
                <!--end nav-->
            </div>
            <!--end header-->
            <div class="page-headline"><?= $titlePage ?></div>
            
            <?= $breadcrumb ?>
            
            <div id="main">
                <?= $content ?>
            </div>
            <div class="cb"></div>
            <!--end main-->
            <div id="footer">
                <p class="copyright">Copyright &copy; <a href="#">Domain Name</a> - All Rights Reserved / Design By <a target="_blank" href="http://www.chris-creed.com/">Chris Creed</a></p>
            </div>
            <!--end footer-->
        </div>
        <!--end wrap-->
    </body>

</html>