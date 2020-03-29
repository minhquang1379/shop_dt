<?php if( !Yii::$app->user->isGuest):?>
<li class="list-group-item">
    <div class="row">
        <div class="col-xs-2 col-md-1">
            <?php if (isset($userInfo)):?>
            <img src="<?= '../../web/upload/avatar/'.$userInfo->image?>" class="img-circle img-responsive" alt="" /></div>
            <?php else:?>
            <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
            <?php endif;?>
        <div class="col-xs-10 col-md-11">
            <a href=""><?= $userInfo->user->username?></a>
            <br>
            <label for=""> Your rating</label>
            <div id="star"></div>
            <input type="hidden" id="rating" value="0">
            <br>
            <textarea name="" id="contentReview" cols="100" rows="5" style="resize: none"  ></textarea><br>
            <div class="btn btn-primary" id="btnReview" >Enter</div>
        </div>
    </div>
</li>
<?php else:?>
    <h2> please login</h2>
<?php endif;?>
