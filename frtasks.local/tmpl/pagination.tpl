<div class="pagination">
    <div class="pages"> <strong>Pages:</strong>
        <ol>
            <?php foreach($pagination->url as $k => $v) : ?>

                <?php if (($k + 1)!= $pagination->active) : ?>
                    <li><a href="<?= $v ?>"> <?=($k + 1) ?></a></li>
                <?php else: ?>
                    <li class="current"> <?=($k + 1) ?></li>
                <?php endif; ?>

            <?php endforeach; ?>
        </ol>
    </div>
</div>
