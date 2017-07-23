<?php foreach($errors as $k => $v) : ?>
    <?php foreach($v as $kk => $vv) : ?>
        <p class="error-p"><?= $vv ?></p>
    <?php endforeach; ?>
<?php endforeach; ?>
