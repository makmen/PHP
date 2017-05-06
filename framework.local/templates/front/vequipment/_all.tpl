{if !empty($vequipment)}
{foreach $vequipment as $k=>$v}
<div class="ambitios_p4">
    <div class="ambitios_wrapper ambitios_p2">
            <h3 class="ambitios_uppercase ambitios_p5">{$v['title']}</h3>
            <div class="ambitios_date">{$v['created']}</div>
    </div>
    <p class="price">Цена: <span>{$v['price']} BYR</span></p>
    <p>{$v['shortcontent']}&nbsp;...</p>
    <div class="ambitios_wrapper">
            <a href="{url $module view}/{$v['id']}" class="ambitios_button_small_rev ambitios_fleft">Просмотреть</a>
    </div>
</div>
{/foreach}
    {if $total_stat >= $onpage}
        {include '_pagging.tpl'} 
    {/if}
{else}
<div class="mess-top">
	<div class="fbok">
		<div class="info">Нет данных</div>
	</div>
</div>
{/if}