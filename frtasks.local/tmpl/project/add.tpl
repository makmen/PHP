<div>
  <form class="ak-form " method="post" action="">

      <?php if ( isset($ok) ) :?>  
        <div class="alertbox success-box">
            <?= $ok?>
        </div>
      <?php endif; ?>

      <div>
        <p>Название проекта</p>
        <input class="w100 <?php echo (isset($errors['title']) ? 'err' : ''); ?>" type="text" name="title" value="<?php echo $project->title??''; ?>"  />
      </div>
      
        <input id="form_submit" class="submit" type="submit" name="submit"  
            <?php if (isset($project) && $project->getId() > 0) : ?>
                value="Обновить проект &raquo;"
            <?php else: ?>
                value="Добавить проект &raquo;"
            <?php endif; ?>
        />

  </form>
</div>