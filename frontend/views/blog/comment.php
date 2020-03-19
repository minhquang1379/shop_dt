<?php
use \yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-8">
        <input type="hidden" id="blogId" value="<?= $blogId?>" >
        <input type="hidden" id="userId" value="<?= Yii::$app->user->getId()?>" >

        <h2 class="page-header">Comments</h2>
        <input type="hidden" id="countComment_0" value="<?= $count?>">
        <input type="hidden" id="displayComment_0" value="<?=$display?>">

        <?php if($count > 5):?>
            <a class="see_comment see_more_0">see more comment</a>
        <?php endif;?>

        <section class="comment-list" id="commentList_0">
           <?= $this->render('/comment/moreComment',[
                    'comments'=>$commentBlog,
                    'display'=>$display
           ])?>
        </section>
        <?php if(!Yii::$app->user->isGuest):?>
            <div class="col-md-2 col-sm-2 hidden-xs">
                <figure class="thumbnail">
                    <?php if(isset($userInfo)):?>
                        <img class="img-responsive" src="<?= '../../web/upload/avatar/'.$userInfo->image?>" />

                    <?php else:?>
                        <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                    <?php endif?>
                    <figcaption class="text-center"><?=Yii::$app->user->identity->username?></figcaption>
                </figure>
            </div>
            <div class="col-md-10 col-sm-10">
                <textarea class="comment_area" ></textarea> <br>
                <div  class="btn btn-primary btn-enter" id="">Enter</div>
            </div>
        <?php endif;?>
    </div>
</div>
