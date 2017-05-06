<?if ($this->out["errs"]["message"]):?>
    <div class="mess-top">
        <div class="error"><div class="msg"><?= $this->out["errs"]["message"]?></div></div>
    </div>
<?endif;?>
<div>
    <form method="post" action="
        <?php
            echo SERVER_ROOT.$this->out['module'].'/'.$this->out['template'].(($this->out['mode']=='edit') ? '/'.$this->out['id'] : '');
        ?>">
    <ol>
      <li>
          <label for="title">Title</label>
          <input id="title" name="title" class="text<?if (isset($this->out['errs']['title'])):?> err<?endif;?>" type="text" value="<?= $this->out['title']?>" />
          <?if (isset($this->out['errs']['title'])):?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['title']?></div>
            </div>
          <?endif;?>
      </li>
      <li>
          <label for="author">Author</label>
          <input id="author" name="author" class="text<?if (isset($this->out['errs']['author'])):?> err<?endif;?>" type="text" value="<?= $this->out['author']?>" />
          <?if (isset($this->out['errs']['author'])):?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['author']?></div>
            </div>
          <?endif;?>
      </li>
      <li>
        <label for="content">Content</label>
        <textarea id="content" name="content" class="<?if (isset($this->out['errs']['content'])):?> err<?endif;?>" rows="8" cols="50"><?= $this->out['content']?></textarea>
          <?if (isset($this->out['errs']['content'])):?>
            <div class="error">
                <div class="msg"><?= $this->out['errs']['content']?></div>
            </div>
          <?endif;?>
      </li>
      <li>
          <input type="submit" name="imageField" id="imageField" src="<?= SERVER_ROOT?>images/submit.gif" class="send" />
      </li>
       <div class="clr"></div>
    </ol>
    </form>
</div>
