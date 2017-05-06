{if !empty($power)}
<div class="ambitios_p4">
    <div class="ambitios_wrapper ambitios_p2">
        <h3 class="ambitios_uppercase ambitios_p5">{$power['title']}</h3>
        <div class="ambitios_date">
            {$power['created']}
            {if $_SESSION['group'] == 1}
            <div class="newsedit">
                <a href="{url $module edit $id}"  onClick="back();">Редактировать</a>
            </div>
            <div class="cb"></div>
            {/if}
        </div>
            <br />
            <p class="price">Цена: <span>{$power['price']} BYR</span></p>
            {$power['content']}
            {if $power['photo'] != ''}
                <div class="ambitios_indent">
                    <img src="{$power['photo']}" width="320" height="150" alt="" />
                </div>
                <br />
            {/if}
            <p class="technical">Основные технические данные:</p>
            <ul>{$power['technical_data']}</ul>
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
        <div class="info">Блок питания не существует</div>
    </div>
</div>
{/if}