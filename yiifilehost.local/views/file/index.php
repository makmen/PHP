<div class="row files">
    <div class="col-sm-12">
        <h2><span>Мои</span> файлы</h2>
        <?php if(!empty($out['files'])): ?>
            <?php foreach($out['files'] as $file): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="row">
                        <div class="col-sm-11">
                            <a href="<?= \yii\helpers\Url::to(['file/download', 'id' => $file->id]) ?>" class="title-file<?= $file->id ?>"> <?= $file->title ?></a> 
                        </div> 
                        <div class="col-sm-1">
                            <span  data-id="<?= $file->id?>" class="glyphicon glyphicon-remove del-file" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            <?php   
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $out['pages'],
                ]);
            ?>
        <?php else :?>
            <div class="alert alert-warning" role="alert">
                <h4 class="clear">Нет загруженных файлов...</h4>
            </div>
        <?php endif;?>
    </div>
</div>