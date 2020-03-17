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
            <li><?= $model->views?> views</li>
            <input type="hidden" value="<?=Yii::$app->user->id?>" id="userId">
            <input type="hidden" value="<?=$model->id?>" id="postId">
        </ul>
    </div>
    <?=$model->content?>
    <div class="created_by"><?= $model->createdBy->email?></div>
</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2 class="page-header">Comments</h2>
            <section class="comment-list">
                <!-- First Comment -->
                <article class="row">
                    <div class="col-md-2 col-sm-2 hidden-xs">
                        <figure class="thumbnail">
                            <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                            <figcaption class="text-center">username</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <div class="panel panel-default arrow left">
                            <div class="panel-body">
                                <header class="text-left">
                                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                </header>
                                <div class="comment-post">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                </div>
                                <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                            </div>
                            <section class="comment-list">
                                <article class="row">
                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                            <figcaption class="text-center">username</figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </p>
                                                </div>
                                                <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="row">
                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                            <figcaption class="text-center">username</figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </p>
                                                </div>
                                                <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="row">
                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                            <figcaption class="text-center">username</figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </p>
                                                </div>
                                                <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="row">
                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                            <figcaption class="text-center">username</figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </p>
                                                </div>
                                                <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </section>
                        </div>
                    </div>
                </article>
            </section>
            <form action="" class="row form_area text-right">
                <div class="col-md-2 col-sm-2 hidden-xs">
                    <figure class="thumbnail">
                        <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                        <figcaption class="text-center">username</figcaption>
                    </figure>
                </div>
                <div class="col-md-10 col-sm-10">
                    <textarea name="" id="" class="comment_area" ></textarea> <br>
                    <input type="submit" value="Comment">
                </div>
            </form>
        </div>
    </div>
</div>