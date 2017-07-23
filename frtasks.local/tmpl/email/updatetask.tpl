
Task #<?= $task->id ?> был обновлен: <?= $currentUser['name'] ?> 
<hr />
<b><?= $task->title ?></b>
<?php if ($oldTask->trecker !=  $task->trecker) : ?>
 Параметра Трекер изменился с <?= $oldTask->trecker ?> на <?= $task->trecker ?><br />
<?php endif; ?>
<?php if ($oldTask->priority != $task->priority) : ?>
 Параметра Приоритет изменился с <?= $oldTask->priority ?> на <?= $task->priority ?><br />
<?php endif; ?>
<?php if ($oldTask->status != $task->status) : ?>
 Параметра Статус изменился с <?= $oldTask->status ?> на <?= $task->status ?><br />
<?php endif; ?>
<?php if ($oldTask->executor != $task->executor) : ?>
<?php if ($oldTask->executor == 0) : ?>
 Параметр Назначена изменился на <?= $executor['name'] ?><br />
<?php elseif($task->executor == 0): ?>
 Значение  <?= $oldExecutor['name'] ?> параметра Назначена удалено<br />
<?php else: ?>
 Параметр Назначена изменился с <?= $oldExecutor['name'] ?> на <?= $executor['name'] ?><br />
<?php endif; ?>
<?php endif; ?>
<hr />
<?= $task->comment ?>
<br />
<br />
<hr />
Task #<?= $task->id ?> автор: <?= $owner['name'] ?> 
<hr />
<?= $task->content ?>