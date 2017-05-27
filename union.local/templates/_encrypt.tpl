<h3 class="ambitios_uppercase">Шифрование файлов</h3>
<?php if ($errs['message']): ?>
    <div class="mess-top">
        <div class="error">
            <div class="msg"><?= $errs['message']?></div>
        </div>
    </div>
<?php endif; ?>

<?php if ($this->out['ok']): ?>
<div class="mess-top">
    <div class="fbok">
        <div class="success">Шифрование завершено, files\ready</div>
    </div>
</div>
<?php else: ?>
    <?php if ( count( $this->out['files'] ) > 0 ): ?>
        <div class="mess-top">
        <?php foreach($this->out['files'] as $file): ?>
            <div class="success">
                <div class="msg"><?= iconv('Windows-1251', 'UTF-8',$file) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
    <div class="mess-top">
        <div class="warning">
            <div class="msg">Нет файлов для шифрования</div>
        </div>
    </div>
    <?php endif; ?>

    <div>
        <form id="register" method="post" action="">
            <div class="fb">
                <div class="description">Введите ключ:</div>
                <div class="date">
                    <input class="w100<?php if (isset($this->out['errs']['key'])): ?> err<?php endif; ?>" type="text" name="key" value="<?= $this->out['key'] ?>" />
                    <?php if (isset($this->out['errs']['key'])): ?>
                    <div class="error">
                        <div class="msg"><?= $this->out['errs']['key'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="cb"></div>
            </div>

            <div class="submit<?php if ( count( $this->out['files'] ) <= 0 ): ?> disabled<?php endif; ?>">
                <input class="btn" type="submit" value="Сохранить" <?php if ( count( $this->out['files'] ) <= 0 ): ?>disabled<?php endif; ?> >
            </div> 
        </form>
    </div>

<?php endif; ?>

