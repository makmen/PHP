<div class="pagenavi">
    <?foreach($this->out["pagging"] as $k=>$v):?>
        <a href="<?= SERVER_ROOT?><?= $this->out['module']?>/<?= $this->out['template']?>?p=<?= $v?>"
           <?if ($this->out['page'] == $v):?> class="current"<?endif;?>><?= $v?></a>&nbsp;
    <?endforeach;?>
        <a href="#">»</a>
</div>