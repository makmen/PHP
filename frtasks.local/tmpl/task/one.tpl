<div>
      <?php if ( isset($ok) ) :?>  
        <div class="alertbox success-box">
            <?= $ok ?>
        </div>
      <?php endif; ?>

    <div class="post task_one" >
        <?php if (isset($task)): ?>
            <?php if ( isset($canEdit) && $canEdit ): ?>
                <p class="edit">
                    <a href="<?= URL::buildUrl(URL::$controller, 'edit', $task['id']) ?>">[edit]</a>
                </p>
            <?php endif; ?>
            <h3 class="post-title"><?= $task['title'] ?></h3>
            <hr />
            <h3 class="post-meta">Добавил(а) <?= $task['name'] ?>: <?= $task['created'] ?></h3>
            <h3 class="post-meta">Трекер: <?= $task['trecker'] ?></h3>
            <h3 class="post-meta">Приоритет: <?= $task['priority'] ?></h3>
            <h3 class="post-meta">Статус: <?= $task['status'] ?></h3>
            <h3 class="post-meta">Назначена: <?php echo (($task['name_executor'] != '') ? $task['name_executor'] : 'Не назначена'); ?></h3>
            <hr />
            <div>
                Описание: <br />
                <?= $task['content'] ?>
            </div>
            
            <?php if (!empty($history)): ?>
                <h3 class="post-meta">История изменений:</h3>

                <?php foreach($history as $k=>$v): ?>
                    <hr />
                    <p>Обновлено <?= $v['history_updated'] ?>: <?= $revision['created'] ?></p>
                    
                    <?php if ($revision['trecker'] != $v['trecker']): ?>
                        <p> - Параметра Трекер изменился с <?= $revision['trecker'] ?> на <?= $v['trecker'] ?></p>
                    <?php endif; ?>
                    
                    <?php if ($revision['priority'] != $v['priority']): ?>
                        <p> - Параметра Приоритет изменился с <?= $revision['priority'] ?> на <?= $v['priority'] ?></p>
                    <?php endif; ?>
                    
                    <?php if ($revision['status'] != $v['status']): ?>
                        <p> - Параметра Статус изменился с <?= $revision['status'] ?> на <?= $v['status'] ?></p>
                    <?php endif; ?>
                    
                    <?php if ($revision['executor'] != $v['executor']): ?>
                        <?php if ($revision['executor'] == 0): ?>
                            <p> - Параметр Назначена изменился на <?= $v['name_executor'] ?></p>
                        <?php elseif($v['executor'] == 0): ?>
                            <p> - Значение <?= $revision['name_executor'] ?> параметра Назначена удалено</p>
                        <?php else: ?>
                            <p> - Параметр Назначена изменился с <?= $revision['name_executor'] ?> на <?= $v['name_executor'] ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if ($v['comment'] != ''): ?>
                        <?= $v['comment'] ?>
                    <?php endif; ?>
                    
                    <?php $revision = $v; ?>
                <?php endforeach; ?>

            <?php endif; ?>
            <?php if (isset($canEditHistory)) : ?>
            <p><a href="<?= URL::buildUrl(URL::$controller, 'update', $task['id'] ) ?>" class="more-link">Обновить &raquo;</a></p>
            <?php endif; ?>  
        </div>
    <?php endif; ?>
</div>