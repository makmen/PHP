<div>
    <?php if( count( $tasks ) ): ?>
    <table class="task_table">
        <thead>
            <tr>
                <th>#</th>
                <th>Трекер</th>
                <th>Статус</th>
                <th>Приоритет</th>
                <th>Тема</th>
                <th>Автор</th>
                <th>Назначена</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tasks as $k=>$v): ?>
            <tr>
                <td>
                    <a href="<?= URL::buildUrl(URL::$controller, 'one', $v['id']) ?>"><?= $v['id'] ?></a>
                </td>
                <td><?= $v['trecker'] ?></td>
                <td><?= $v['status'] ?></td>
                <td><?= $v['priority'] ?></td>
                <td>
                    <a href="<?= URL::buildUrl(URL::$controller, 'one', $v['id']) ?>"><?= $v['title'] ?></a>
                </td>
                <td><?= $v['name'] ?></td>
                <td><?= $v['name_executor'] ?></td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?= $pagination->showRender() ?>
    
    <?php else: ?>
        <div class="alertbox error-box">
            Нет ни одного проекта в разделе 
        </div>
    <?php endif; ?>
    
    <div class="space">&nbsp;</div>
    <?php if (isset($canAdd)) : ?>
    <div>
        <p><a href="<?= URL::buildUrl(URL::$controller, 'index') ?>">Добавить новую задачу</a></p> 
    </div>
    <?php endif; ?>
    
</div>