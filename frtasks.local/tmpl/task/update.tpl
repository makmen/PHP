<div>
  <form class="ak-form" method="post" action="">

      <?php if ( isset($errors) &&  count($errors) >0 ) :?>  
        <?= $allErrors?>
      <?php endif; ?>
      
      <?php if ( $canUpdateAllfields ) :?>  
      <div>
        <p>Трекер</p>
        <select class="w50" name="trecker">
            <?php foreach($trecker as $k=>$v): ?>
            <option value="<?= $k ?>" <?php if ($k == $history->trecker) : ?>selected<?php endif?>  ><?= $v ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>
      
      <div>
        <p>Комментарий</p>
        <textarea id="editor" class="w100 <?php echo (isset($errors['comment']) ? 'err' : ''); ?>" rows="10" cols="40" name="comment"><?php echo $history->comment??''; ?></textarea>
      </div>
      
      <?php if ( $canUpdateAllfields ) :?>  
      <div>
        <p>Приоритет</p>
        <select class="w50" name="priority" <?php echo (isset($errors['="priority']) ? 'err' : ''); ?>>
            <?php foreach($priority as $k=>$v): ?>
                <option value="<?= $k ?>" <?php if ($k == $history->priority) : ?>selected<?php endif?>  ><?= $v ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>

      <?php if ( $canUpdateAllfields || $canUpdateStatus ) :?>  
      <div>
        <p>Статус</p>
        <select class="w50" name="status" <?php echo (isset($errors['="status']) ? 'err' : ''); ?>>
            <?php foreach($status as $k=>$v): ?>
                <option value="<?= $k ?>" <?php if ($k == $history->status) : ?>selected<?php endif?>  ><?= $v ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>
      
      <?php if ( $canUpdateAllfields ) :?>  
      <div>
        <p>Назначена</p>
        <select class="w50" name="executor">
            <option value="0"></option>
            <?php foreach($users as $v): ?>
                <option value="<?= $v['id'] ?>" <?php if ($v['id'] == $history->executor) : ?>selected<?php endif?>  ><?= $v['name'] ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>
      
      <div class="space">&nbsp;</div>
      <input id="form_submit" class="submit" type="submit" name="submit" value="Обновить &raquo;" />

  </form>
    
    <script>
        CKEDITOR.replace('editor');
    </script>
</div>