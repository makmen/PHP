<div>
    <?php if( count( $users ) ): ?>
    <table class="task_table">
        <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Логин</th>
                <th>email</th>
                <th>Роль</th>
                <th>Дата регистрации</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $k=>$v): ?>
            <tr>
                <td>
                    <?php if (isset($canEdit)) : ?>
                        <a href="<?= URL::buildUrl(URL::$controller, 'edit', $v['id']) ?>"><?= $v['id'] ?></a>
                    <?php else: ?>
                        <?= $v['id'] ?>
                    <?php endif; ?>
                </td>
                <td><?= $v['name'] ?></td>
                <td>
                    <?php if (isset($canEdit)) : ?>
                        <a href="<?= URL::buildUrl(URL::$controller, 'edit', $v['id']) ?>"><?= $v['login'] ?></a>
                    <?php else: ?>
                        <?= $v['login'] ?>
                    <?php endif; ?>
                </td>
                <td><?= $v['email'] ?></td>
                <td><?= $v['role_name'] ?></td>
                <td><?= $v['created'] ?></td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?= $pagination->showRender() ?>
    
    <?php else: ?>
        <div class="alertbox error-box">
            Нет данных для отображения
        </div>
    <?php endif; ?>
    <div class="space">&nbsp;</div>
    <?php if (isset($canAdd)) : ?>
    <div>
        <p><a href="<?= URL::buildUrl('auth', 'register') ?>">Добавить нового пользователя</a></p> 
    </div>
    <?php endif; ?>
          
</div>