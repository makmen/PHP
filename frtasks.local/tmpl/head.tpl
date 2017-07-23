<title><?=$title?></title>
<?php foreach($meta as $m): ?>
    <meta <?php if ($m->http_equiv) { ?>http-equiv<?php } else { ?>name<?php } ?>="<?=$m->name?>" content="<?=$m->content?>" />
<?php endforeach; ?>

<?php if ($favicon): ?>
        <link href="<?=$favicon?>" rel="shortcut icon" type="image/x-icon" />
<?php endif; ?>
<?php foreach ($css as $href): ?>
        <link type="text/css" rel="stylesheet" href="<?=$href?>" />
<?php endforeach; ?>
<?php foreach ($js as $src): ?>
        <script type="text/javascript" src="<?=$src?>"></script>
<?php endforeach; ?>
<?php foreach ($ie as $k => $v): ?>
    <!--[if <?=$k ?>]><link rel="stylesheet" href="<?=$v ?>" /><![endif]-->
<?php endforeach; ?>
    
