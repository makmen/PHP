
Task #<?= $task->id ?> автор: <?= $owner['name'] ?> 
<hr />
<b><?= $task->title ?></b>
 Trecker: <?= $task->trecker ?><br />
 Priority: <?= $task->priority ?><br />
 Status: <?= $task->status ?><br />
 Assignee: <?= $executor['name'] ?><br />
<hr />
<?= $task->content ?>