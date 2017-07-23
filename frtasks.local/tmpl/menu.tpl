<ul class="menu">
    <?php if( isset($items) &&  count($items) > 0 ): ?>
        <?php foreach($items as $k=>$v): ?>
        <li><a href="<?= $server_name?>/<?= $v['path'] ?>"><?= $v['title'] ?></a>
            <?php if(isset($v['children'])): ?>
                <ul class="sub-menu">
                <?php foreach($v['children'] as $kk=>$vv): ?>
                <li><a href="<?= $server_name?>/<?= $vv['path'] ?>"><?= $vv['title'] ?></a></li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>