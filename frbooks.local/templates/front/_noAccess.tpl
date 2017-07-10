<div class="mess-top">
    <div class="error">
    <h2 class="noaccess">Доступ запрещен</h2>
        <div class="msg">
            <?= ($this->out["noAccess"] == 1) ?
                "У вас нет прав на доступ к этому разделу" :
                $this->out["noAccess"]?>
        </div>
    </div>
</div>
