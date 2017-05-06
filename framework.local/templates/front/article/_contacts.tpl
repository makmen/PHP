<h3 class="ambitios_uppercase">Контактная информация </h3>
<div id="contact_form">
    <div id="Note"></div>
    {if $errs['sendError']} 
        <div class="mess-top">
            <div class="error">
                <div class="msg">{$errs['sendError']}</div>
            </div>
        </div>
    {elseif $sendSuccess}
        <div class="mess-top">
            <div class="fbok">
                <div class="success">Письмо отправлено</div>
            </div>
        </div>
    {/if}
    <form class="cmxform" id="contactform" method="post" action="{url $module $template}">
        <div class="field ambitios_input_standat_height ambitios_p2">
                <label for="name">Имя</label>
                <input id="name" name="name" class="required{if isset($errs['name'])} err{/if}" type="text" value="{$name}" />
        </div>
        <div class="field ambitios_input_standat_height ambitios_p2">
                <label for="email">Email</label>
                <input id="email" name="email" class="required email{if isset($errs['email'])} err{/if}" type="text" value="{$email}" />
        </div>
        <div class="ambitios_textarea ambitios_p2 field">
                <label for="message">Сообщение</label>
                <textarea id="message" name="message" class="required{if isset($errs['message'])} err{/if}" rows="5" cols="10">{$message}</textarea>
        </div>
        <div>
            <div class="buttons-wrapper">
                <div class="ambitios_wrapper ambitios_p2">
                    <div class="ambitios_button_contact">
                        <input type="submit" value="Send" name="contactus" id="contactus" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="ambitios_wrapper">
    <div class="ambitios_fleft">
        <h3 class="ambitios_uppercase">Директор: Высоцкий Василий Семенович </h3>
        Phone: +375 29 615 14 12<br />
        Fax: 8017 125 32 64<br />
        Email: <a href="mailto:mail@vactt@mail.ru">vactt@mail.ru</a><br /> 
        Email: <a href="mailto:mail@vvs200362@list.ru">vvs200362@list.ru</a> 
    </div>
</div>
<br />
<div class="ambitios_picture ambitios_p2">
    <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=eG5OG_eatgnABSizBk2fviWWJi38Kdu4&width=100%&height=400&lang=ru_RU&sourceType=constructor"></script>
</div>
