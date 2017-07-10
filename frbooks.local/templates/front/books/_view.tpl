<?if (!empty($this->out["books"])):?>
<div class="article">
    <h2><?= $this->out['books']['title']?></h2>
    <div class="ambitios_date">
        <?= $this->out['books']['created']?>
        <?if (isset($_SESSION['account_id']) && $_SESSION['account_id'] == $this->out['books']['account_id']):?>
        <div class="newsedit">
            <a href="<?= SERVER_ROOT?><?= $this->out['module']?>/edit/<?= $this->out['books']['id']?>"  onClick="back();">Редактировать</a>
        </div>
        <div class="cb"></div>
        <?endif;?>
    </div>
        <br />
    <?= $this->out['books']['content']?>
    <a href="javascript:void(0)" onClick="back();">Вернуться на предыдущую страницы</a>
</div>
<script type="text/javascript" language="javascript">
function back() { 
    history.go(-1);
}
</script>
<?else:?> 
<div class="mess-top">
    <div class="fbok">
        <div class="info">Такой книги еще не существует</div>
    </div>
</div>
<?endif;?>
