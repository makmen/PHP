<ul class="ambitios_menu">
  <li><a href="<?= SERVER_ROOT?>" <?php if ($this->out["module"] == '') { echo 'class="ambitios_active"'; } ?>><span><span>Главная</span></span></a></li>
  <li><a href="<?= SERVER_ROOT?>encrypt" <?php if ($this->out["module"] == 'encrypt') { echo 'class="ambitios_active"'; } ?>><span><span>Зашифровать</span></span></a></li>
  <li><a href="<?= SERVER_ROOT?>decode" <?php if ($this->out["module"] == 'decode') { echo 'class="ambitios_active"'; } ?>><span><span>Расшифровать</span></span></a></li>
  <li><a href="<?= SERVER_ROOT?>contacts" <?php if ($this->out["module"] == 'contacts') { echo 'class="ambitios_active"'; } ?>><span><span>Контакты</span></span></a></li>
</ul>