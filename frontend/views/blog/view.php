<?php

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
<div class="blog_content">
    <h3><?= $model->title?></h3>
    <div class="created_at"><?= date('y-m-d H:i:s', $model->created_at)?></div>
    <div class="features">
        <ul>
            <li><i class="fas fa-thumbs-up" id="likeBtn"></i></li>
            <li><?= $model->views?> views</li>
            <li><?= $model->like?> like</li>
            <input type="hidden" value="<?=Yii::$app->user->id?>" id="userId">
            <input type="hidden" value="<?=$model->id?>" id="postId">
        </ul>
    </div>
    <?=$model->content?>
    <div class="created_by"><?= $model->createdBy->email?></div>
</div>
</div>