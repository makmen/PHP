<div class="ambitios_pagination">
    {foreach $pagging as $k=>$v}
        <a href="{url $module $template}?p={$v}" {if $page == $v}class="currentpagging"{/if}>{$v}</a>&nbsp;
    {/foreach}
</div>