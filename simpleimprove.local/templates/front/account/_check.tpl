<?php
    if (!isset($_SESSION['login'])) {
?>
<div class="access">
    <form method="post" action="">
        <span class="in">
            <input type="text" value="" name="formlogin" placeholder="login..." />
        </span>
        <span class="in">
            <input type="password" value="" name="formpassword" placeholder="password..." />
        </span>
        <input name="logIn" value="1" type="hidden">
        <input name="searchsubmit" type="image" src="<?= SERVER_ROOT?>images/search.gif" value="Go"  class="btn"  />
    </form>
    <div class="clr"></div>
    <div>
        &nbsp;<span class="errorlogin" <?php if (!$this->out['checkfalse']) { ?>style="display:none; <?php } ?>">Не верный логин или пароль</span>
    </div>
    <span class="register">
        <a href="<?= SERVER_ROOT?>account">Регистрация</a>
    </span>
    <span class="forget">
        <a href="<?= SERVER_ROOT?>account/forget">Забыли пароль</a>
    </span>
</div>
<div class="clr"></div>
<?php
    } else {
?>
<div class="access">
    <span>
        Добрый день, <?= $_SESSION['name']?> <?= $_SESSION['middlename']?> <?= $_SESSION['lastname']?>
    </span>
    <br />
    <span>
        <?php
            if ($_SESSION['group'] == 1) {
                echo "Вы вошли, как Пользователь";
            }
        ?>
    </span>
</div>
<div class="clr"></div>
<?php
    }
?>