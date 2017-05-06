<h3 class="register">{if $mode =='add'}Добавить новость{else}Редактировать новость{/if}</h3>
{if $errs['message']} 
    <div class="mess-top">
        <div class="error"><div class="msg">{$errs['message']}</div></div>
    </div>
{/if}
<div>
    <form id="register" method="post" action="{url $module $template}{if $mode =='edit'}/{$id}{/if}">
        <div class="fb">
                <div class="description">Название:</div>
                <div class="date">
                        <input class="w100{if isset($errs['title'])} err{/if}" type="text" name="title" value="{$title}" />
                        {if isset($errs['title'])}
                                <div class="error">
                                        <div class="msg">{$errs['title']}</div>
                                </div>
                        {/if}
                </div>
                <div class="cb"></div>
        </div>
        <div class="fb">
                <div class="description">Содержание:</div>
                <div class="date">
                        <textarea id="content" name="content" class="w100{if isset($errs['content'])} err{/if}" rows="30" cols="10">{$content}</textarea>
                        {if isset($errs['content'])}
                                <div class="error">
                                        <div class="msg">{$errs['content']}</div>
                                </div>
                        {/if}
                </div>
                <div class="cb"></div>
        </div>
        <div class="submit news">
                 <input class="btn" type="submit" value="Сохранить">
        </div> 
    </form>
</div>
