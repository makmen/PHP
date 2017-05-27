<h1 class="ambitios_uppercase">Контактная информация </h1>
<div id="contact_form">
    <div id="Note"></div>
    <?php
        if ($this->out["errs"]["sendError"]) {
    ?>
        <div class="mess-top">
            <div class="error">
                <div class="msg"><? echo $this->out['errs']['sendError']; ?></div>
            </div>
        </div>
    <?php
        } elseif ($this->out["sendSuccess"]) {
    ?>    
        <div class="mess-top">
            <div class="fbok">
                <div class="success">Письмо отправлено</div>
            </div>
        </div>
    <?php
       }
    ?>   
    <form class="cmxform" id="contactform" method="post" action="">
        <div class="field ambitios_input_standat_height ambitios_p2">
            <label for="name">Имя</label>

            <input id="name" name="name" class="required<?php if (isset($this->out['errs']['name'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['name']; ?>" />
        </div>
        <div class="field ambitios_input_standat_height ambitios_p2">
            <label for="email">Email</label>
            <input id="email" name="email" class="required email<?php if (isset($this->out['errs']['email'])) { echo ' err'; } ?>" type="text" value="<? echo $this->out['email']; ?>" />
        </div>
        <div class="ambitios_textarea ambitios_p2 field">
            <label for="message">Сообщение</label>
            <textarea id="message" name="message" class="required<?php if (isset($this->out['errs']['message'])) { echo ' err'; } ?>" rows="5" cols="10"><? echo $this->out['message']; ?></textarea>
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
        <h3 class="ambitios_uppercase">Разработчик: Макась Андрей Казимирович </h3>
        Phone: +375 29 264 70 37<br />
        Email: <a href="mailto:mail@vactt@mail.ru">andreymakas@inbox.ru</a><br /> 
        Email: <a href="mailto:mail@vvs200362@list.ru">makmen@inbox.ru</a> 
    </div>
</div>
<br />
<div class="ambitios_picture ambitios_p2">
    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Abda88459f51edfde26d637a5af4b7f895124bdf044aae5fdf7c8635b0c82a176&amp;width=620&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
</div>
