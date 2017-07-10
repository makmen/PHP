<div class="mess-top">
    <div class="error">
    <h2 class="noaccess">Доступ запрещен noAccessAjax</h2>
        <div class="msg">
            <?php
                if ($this->out["noAccess"] == 1) {
                    echo "У вас нет прав на доступ к этому разделу";
                } else {
                    echo $this->out["noAccess"];
                }
            ?>
        </div>
    </div>
</div>
