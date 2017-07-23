<div>
  <form class="ak-form" method="post" action="">

      <?php if ( isset($ok) ) :?>  
        <div class="alertbox success-box">
            <?= $ok?>
        </div>
      <?php endif; ?>
      
      <?php if ( isset($errors) &&  count($errors) >0 ) :?>  
        <?= $allErrors?>
      <?php endif; ?>
      
      <?php if ( !$task->getId() ) : ?>  
      <div>
        <p>Трекер</p>
        <select class="w50" name="trecker">
            <?php foreach($trecker as $k=>$v): ?>
            <option value="<?= $k ?>" <?php if ($k == $task->trecker) : ?>selected<?php endif?>  ><?= $v ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>
      
      <div>
        <p>Тема задача</p>
        <input class="w100 <?php echo (isset($errors['title']) ? 'err' : ''); ?>" type="text" name="title" value="<?php echo $task->title??''; ?>"  />
      </div>
      
      <div>
        <p>Описание</p>
        <textarea id="editor" class="w100 <?php echo (isset($errors['content']) ? 'err' : ''); ?>" rows="10" cols="40" name="content"><?php echo $task->content??''; ?></textarea>
      </div>
      
      <?php if ( !$task->getId() ) : ?>  
      <div>
        <p>Приоритет</p>
        <select class="w50" name="priority" <?php echo (isset($errors['="priority']) ? 'err' : ''); ?>>
            <?php foreach($priority as $k=>$v): ?>
                <option value="<?= $k ?>" <?php if ($k == $task->priority) : ?>selected<?php endif?>  ><?= $v ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      
      <div>
        <p>Назначена</p>
        <select class="w50" name="executor">
            <option value="0"></option>
            <?php foreach($users as $v): ?>
                <option value="<?= $v['id'] ?>" <?php if ($v['id'] == $task->executor) : ?>selected<?php endif?>  ><?= $v['name'] ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>
      
      <div class="space">&nbsp;</div>
      
      <input id="form_submit" class="submit" type="submit" name="submit" value="Добавить задачу &raquo;" />

  </form>
    
    <script>
        CKEDITOR.replace('editor');
    </script>
</div>