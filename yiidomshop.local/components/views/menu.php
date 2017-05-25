<li>
    <a href="<?= yii\helpers\Url::to( ['category/view', 'id' => $category['id']] ) ?>"><?= $category['name'] ?>
    <?php if ( isset($category['childs']) ): ?>
        <span class="plus pull-right glyphicon glyphicon-plus"></span>
    <?php endif; ?>
    </a>
    <?php if ( isset($category['childs']) ): ?>
        <ul>
            <?= $this->getMenuHtml( $category['childs'] ) ?>
        </ul>
    <?php endif; ?>
</li>
