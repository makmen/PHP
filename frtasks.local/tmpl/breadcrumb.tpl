<div class="crumb">
    <?php $count = count($data); ?>
    <?php if ( $count > 1 )  : ?>
    <p>
        <?php foreach($data as $k=>$v) : ?>
            <?php if ($k != ($count - 1))  : ?>
                <a href="<?= $v->link ?>"><?= $v->title ?></a>&nbsp;&gt;&nbsp;
            <?php else: ?>
                <?= $v->title ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </p>
    <?php endif; ?>
</div>