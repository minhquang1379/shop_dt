<?php
?>
<?php if(!Yii::$app->user->isGuest):?>
    <div class="col-md-2 col-sm-2 hidden-xs">
        <figure class="thumbnail">
            <?php if(isset($userInfo)):?>
                <img class="img-responsive" src="<?= '../../web/upload/avatar/'.$userInfo->image?>" />

            <?php else:?>
                <img class="img-responsive" src="https://img.thuthuatphanmem.vn/uploads/2018/09/19/avatar-facebook-chat-4_105604005.jpg" />
            <?php endif?>
            <figcaption class="text-center"><?=Yii::$app->user->identity->username?></figcaption>
        </figure>
    </div>
    <div class="col-md-10 col-sm-10">
        <textarea class="comment_area" id="<?= isset($parentId)? $parentId:'' ?>" ></textarea> <br>
        <div  class="btn btn-primary btn-enter" id="<?= isset($parentId)? $parentId:'' ?>">Enter</div>
    </div>
<?php else:?>
<h7 class="danger">Login to comment this blog</h7>
<?php endif;?>
