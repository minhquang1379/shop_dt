<?php
?>
<article class="row">
    <div class="col-md-2 col-sm-2 hidden-xs">
        <figure class="thumbnail">
            <?php if(!empty($newComment->getAvatar())):?>
                <img class="img-responsive" src="<?= '../../web/upload/avatar/'.$newComment->getAvatar()?>" />
            <?php else:?>
                <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
            <?php endif;?>
            <figcaption class="text-center"><?= $newComment->user->username?></figcaption>
        </figure>
    </div>
    <div class="col-md-10 col-sm-10">
        <div class="panel panel-default arrow left">
            <div class="panel-body">
                <header class="text-left">
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?=date('y-m-d H:i:s',$newComment->created_at)?></time>
                </header>
                <div class="comment-post">
                    <p>
                        <?= $newComment->content?>
                    </p>
                </div>
                <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
            </div>
        </div>
    </div>
</article>