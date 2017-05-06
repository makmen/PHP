{if !empty($news)}
<div class="ambitios_p4">
    <div class="ambitios_wrapper ambitios_p2">
        <h3 class="ambitios_uppercase ambitios_p5">{$news['title']}</h3>
        <div class="ambitios_date">
            {$news['created']}
            {if $_SESSION['group'] == 2 && $_SESSION['account_id'] == $news['account_id']}
                <div class="newsedit">
                    <a href="{url $module edit $id}"  onClick="back();">Редактировать</a>
                </div>
                <div class="cb"></div>
            {/if}
        </div>
            <br />
            {$news['content']}
    </div>
    <a href="javascript:void(0)" onClick="back();">Вернуться на предыдущую страницы</a>
</div>
<script type="text/javascript" language="javascript">
function back() { 
    history.go(-1);
}
</script>
{else}
<div class="mess-top">
    <div class="fbok">
        <div class="info">Новость не существует или была удалена</div>
    </div>
</div>
{/if}