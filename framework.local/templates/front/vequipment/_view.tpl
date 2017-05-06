{if !empty($vequipment)}
<div class="ambitios_p4">
	<div class="ambitios_wrapper ambitios_p2">
            <h3 class="ambitios_uppercase ambitios_p5">{$vequipment['title']}</h3>
            <div class="ambitios_date">
                {$vequipment['created']}
                {if $_SESSION['group'] == 1}
                <div class="newsedit">
                        <a href="{url $module edit $id}"  onClick="back();">Редактировать</a>
                </div>
                <div class="cb"></div>
                {/if}
            </div>
                <br />
                <p class="price">Цена: <span>{$vequipment['price']} BYR</span></p>
                {$vequipment['content']}
                {if $vequipment['photo'] != ''}
                    <div class="ambitios_indent">
                            <img src="{$vequipment['photo']}" width="450" height="340" alt="" />
                    </div>
                    <br />
                {/if}
                {if (!empty($powers))}
                    <p class="technical">Источники питания:</p>
                    <ul>
                    {foreach $powers as $k=>$v}
                        <li><a href="{url power view}/{$v['id']}">{$v['title']}</a></li>
                    {/foreach}
                    </ul>
                    <br />
                {/if}
                <p class="technical">Основные технические данные:</p>
                <ul>{$vequipment['technical_data']}</ul>
                <br />
                <p class="technical">Состав установки:</p>
                <ul>{$vequipment['composition']}</ul>
	</div>
	<a href="{url vequipment}">Список оборудования</a>
</div>
<script type="text/javascript" language="javascript">
function back() { 
    history.go(-1);
}
</script>
{else}
<div class="mess-top">
    <div class="fbok">
        <div class="info">Нет записей</div>
    </div>
</div>
{/if}