<div id="projects-content">
    
      <?php if ( isset($message) ) :?>  
        <div class="alertbox error-box">
            <?= $message?>
        </div>
      <?php endif; ?>

    <?php if( count( $projects ) ): ?>
        <div class="content">
            <?php foreach($projects as $k=>$v): ?>
                <div class="one-third">
                    <div class="price-table">
                        <div class="head <?= $v['color'] ?>">
                            <p> Название проекта </p>
                            <h2 class="price">
                                <a href="<?= URL::buildUrl(URL::$controller, 'view', $v['id']) ?>"> <?= mb_substr($v['title'],0,20) ?> </a>
                            </h2>
                        </div>
                        <div class="body">
                            <ul>

                                <?php if( count( $v['tasks'] ) ): ?>
                                        <li> <a href="<?= URL::buildUrl('task', 'view') ?>?pr=<?=$v['id'] ?>">Всего задач</a>: <?= $v['totalCnt'] ?> </li>
                                    <?php foreach($v['tasks'] as $kk=>$vv): ?>
                                        <li> <a href="<?= URL::buildUrl('task', 'view', array_search($vv['trecker'], Task::$trecker) ) ?>?pr=<?=$v['id'] ?>"><?= $vv['trecker'] ?></a>: <?= $vv['cnt'] ?> </li>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </ul>
                            <p class="more">&nbsp;
                            <?php if ($v['user_id'] == $user['id']) : ?>
                                <a href="<?= URL::buildUrl(URL::$controller, 'edit', $v['id'] )?>">Edit</a>
                            <?php endif; ?>
                            </p>

                        </div>
                    </div>
                </div>
            
                <?php if ( (($k + 1)%3)==0 ) : ?>
                    <div class="cb"></div>
                <?php endif; ?>
            
            <?php endforeach; ?>
        </div>
    
        <div class="cb"></div>
        
        <?= $pagination->showRender() ?>
        
    <?php else: ?>
        <div class="alertbox error-box">
            Нет ни одного проекта
        </div>
    <?php endif; ?>
    <div class="space"></div>
    <?php if (isset($canAdd)) : ?>
    <div>
        <p><a href="<?= URL::buildUrl(URL::$controller, 'add') ?>">Добавить новый проект</a></p> 
    </div>
    <?php endif; ?>
</div>
