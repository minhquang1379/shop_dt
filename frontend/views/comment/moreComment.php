<?php
?>


<!-- First Comment -->
<?php foreach ($comments as $comment):?>
<article class="row" >
    <div class="col-md-2 col-sm-2 hidden-xs">
        <figure class="thumbnail">
            <?php if($comment->getAvatar()):?>
                <img class="img-responsive" src="<?= '../../web/upload/avatar/'.$comment->getAvatar()?>" />
            <?php else:?>
                <img class="img-responsive" src="https://img.thuthuatphanmem.vn/uploads/2018/09/19/avatar-facebook-chat-4_105604005.jpg" />
            <?php endif;?>
            <figcaption class="text-center"><?= $comment->user->username?></figcaption>
        </figure>
    </div>
    <div class="col-md-10 col-sm-10">
        <div class="panel panel-default arrow left">
            <div class="panel-body">
                <header class="text-left">
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?=date('y-m-d H:i:s',$comment->created_at)?></time>
                </header>
                <div class="comment-post">
                    <p>
                        <?= $comment->content?>
                    </p>
                </div>
                <p class="text-right"><a  class="btn btn-default btn-sm btnReply" id="<?= $comment->id?>" ><i class="fa fa-reply"></i> reply</a></p>
            </div>
            <?php if(!empty($comment->commentBlogs)):?>
                <input type="hidden" id="countComment_<?=$comment->id?>" value="<?= $comment->getCommentBlogs()->count()?>">
                <input type="hidden" id="displayComment_<?=$comment->id?>" value="5">
                <a class="see_comment see_more_<?=$comment->id?>" id="<?= $comment->id?>">see more comment</a>
            <?php endif;?>
        </div>
        <section class="comment-list" id="commentList_<?=$comment->id?>">

        </section>
<!--form-->
    </div>
</article>

<?php endforeach;?>

