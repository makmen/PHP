  <form class="form-permission" method="post" action="">

      <?php if ( isset($ok) ) :?>  
        <div class="alertbox success-box">
            <?= $ok?>
        </div>
      <?php endif; ?>
      
      <?php if ( isset($error) ) :?>  
        <div class="alertbox error-box">
            <?= $error?>
        </div>
      <?php endif; ?>

      <table class="permission_table">
        <thead>
            <th>Привилегии</th>
            <?php if( count( $roles ) ): ?>

                <?php foreach($roles as $item): ?>
                    <th><?= $item['name'] ?></th>
                <?php endforeach; ?>

            <?php endif; ?>
        </thead>
        <tbody>
            <?php if( count( $permissions ) ): ?>
                <?php foreach($permissions as $item): ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <?php foreach($roles as $role): ?>
                        <td>
                            <?php if( Permission::hasPermission($item['id'], $role['id'], $permissions_roles ) ): ?>
                            <input checked name="<?= $role['id'] ?>[]"  type="checkbox" value="<?= $item['id'] ?>">
                            <?php else: ?>
                            <input name="<?= $role['id'] ?>[]"  type="checkbox" value="<?= $item['id'] ?>">
                            <?php endif; ?>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
      </table>
      
      <div class="space">&nbsp;</div>
    
      <?php if (isset($canEdit)) : ?>
          <input id="form_submit" class="submit" type="submit" name="submit" value="Обновить &raquo;" />
      <?php endif; ?>
      
  </form> 

