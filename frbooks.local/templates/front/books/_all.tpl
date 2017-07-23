<div class="article">
        <?php 
        if (!empty($this->out["books"])) {
            foreach($this->out["books"] as $k=>$v) { 
        ?>
            <h2><?= $v['title']?></h2>
            <p class="post-data"><?= $v['created']?></p>
            <p><?= $v['shortcontent']?>&nbsp;...</p>
            <div>
                <a href="<?= SERVER_ROOT?><?= $this->out['module']?>/view/<?= $v['id']?>" class="ambitios_button_small_rev ambitios_fleft">Читать</a>
            </div>
            <br />
        <?php 
            }
            if ($this->out['total_stat'] >= $this->out['totalonpagestat']) {
                include(DOC_ROOT . 'templates/front/_pagging.tpl');
            }
        } else {
        ?>
    <div class="mess-top">
        <div class="fbok">
            <div class="info">Нет данных</div>
        </div>
    </div>
    <?php } ?>
    
</div>
