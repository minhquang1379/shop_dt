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
      <?= $this->render('/comment/form',[
              'userInfo'=>$userInfo,
      ])?>
    </div>
</div>
