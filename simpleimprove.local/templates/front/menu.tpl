<div class="menu_nav">
  <ul>
    <li <?php if ($this->out["module"] == '') { echo 'class="active"'; } ?>><a href="<?= SERVER_ROOT?>">Home</a></li>
    <li <?php if ($this->out["module"] == 'article' && $this->out["template"] == 'about') { echo 'class="active"'; } ?>><a href="<?= SERVER_ROOT?>article/about">About Us</a></li>
    <li <?php if ($this->out["module"] == 'books') { echo 'class="active"'; } ?>><a href="<?= SERVER_ROOT?>books">Books</a></li>
    <li <?php if ($this->out["module"] == 'article' && $this->out["template"] == 'contact') { echo 'class="active"'; } ?>><a href="<?= SERVER_ROOT?>article/contact">Contact Us</a></li>
    <?php
        if (isset($_SESSION['group'])) {
    ?>
    <li><a href="<?= SERVER_ROOT?>account/edit">My profile</a></li>
    <li><a href="<?= SERVER_ROOT?>account/logout">Log out</a></li>
    <?php } ?>
  </ul>
    
  <div class="clr"></div>
</div>
