<h3 class="ambitios_uppercase">Расшифрование файлов </h3>
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
        <div class="success">Завершено успешно, дирректория files\decode</div>
    </div>
</div>
<?php else: ?>
    <?php if ( count( $this->out['files'] ) == 0 || count( $this->out['files'] ) < FILE_NUM_READY ): ?>
        <div class="mess-top">
            <div class="warning">
                <div class="msg">Не достаточно файлов для шифрования</div>
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

            <div class="submit<?php if ( count( $this->out['files'] ) == 0 || count( $this->out['files'] ) < FILE_NUM_READY ): ?> disabled<?php endif; ?>">
                <input class="btn" type="submit" value="Сохранить" <?php if ( count( $this->out['files'] ) == 0 || count( $this->out['files'] ) < FILE_NUM_READY ): ?>disabled<?php endif; ?> >
            </div> 
        </form>
    </div>

<?php endif; ?>
