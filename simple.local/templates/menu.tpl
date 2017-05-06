<ul class="ambitios_menu">
  <li><a href="<?= SERVER_ROOT?>" <?php if ($this->out["module"] == '') { echo 'class="ambitios_active"'; } ?>><span><span>Главная</span></span></a></li>
  <li><a href="<?= SERVER_ROOT?>technology" <?php if ($this->out["module"] == 'technology') { echo 'class="ambitios_active"'; } ?>><span><span>Технологии</span></span></a></li>
  <li><a href="<?= SERVER_ROOT?>gallery" <?php if ($this->out["module"] == 'gallery') { echo 'class="ambitios_active"'; } ?>><span><span>Фотогалерея</span></span></a></li>
  <li><a href="<?= SERVER_ROOT?>comment" <?php if ($this->out["module"] == 'comment') { echo 'class="ambitios_active"'; } ?>><span><span>Отзывы</span></span></a></li>
  <li><a href="<?= SERVER_ROOT?>contacts" <?php if ($this->out["module"] == 'contacts') { echo 'class="ambitios_active"'; } ?>><span><span>Контакты</span></span></a></li>
</ul>