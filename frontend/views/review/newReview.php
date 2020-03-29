<?php if ( isset($review)):?>
<li class="list-group-item">
    <div class="row">
        <div class="col-xs-2 col-md-1">
            <?php if ($review->getAvatar()):?>
            <img src="<?= '../../web/upload/avatar/'.$review->getAvatar()?>" class="img-circle img-responsive" alt="" /></div>
        <?php else:?>
        <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
    <?php endif;?>
    <div class="col-xs-10 col-md-11">
        <div>
            <a href=""><?= $review->user->username?></a>
            <div class="mic-info">
                <span class="stars"><?= $review->rating?></span>
            </div>
        </div>
        <div class="comment-text">
            <?= $review->content?>
        </div>
    </div>
    </div>
</li>
<?php endif;?>
