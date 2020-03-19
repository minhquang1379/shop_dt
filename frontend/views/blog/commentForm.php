<?php
?>
<form action="" class="row form_area text-right">
    <div class="col-md-2 col-sm-2 hidden-xs">
        <figure class="thumbnail">
           <?php if(isset($userInfo)):?>
               <img class="img-responsive" src="<?= '../../web/upload/avatar/'.$userInfo->getAvatar()?>" />

            <?php else:?>
               <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
           <?php endif?>
            <figcaption class="text-center"><?= Yii::$app->user->username?></figcaption>
        </figure>
    </div>
    <div class="col-md-10 col-sm-10">
        <textarea name="" id="" class="comment_area" ></textarea> <br>
        <input type="submit" value="Comment">
    </div>
</form>
