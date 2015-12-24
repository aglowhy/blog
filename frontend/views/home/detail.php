<?php
/**
 * Created by PhpStorm.
 * User: 慕虚云
 * Date: 2015/12/14 0014
 * Time: 12:04
 */

use yii\helpers\Html;
use common\models\Comment;

use frontend\widgets\RecentPosts;
use frontend\widgets\RecentComments;
use frontend\widgets\TagCloud;
use frontend\widgets\CateList;

$this->title = $model->title;


?>

<div class="content-left">

    <div class="primary">
        <div class="article">

            <h2 class="entry-title"><a href="<?= $model->url; ?>"><?= Html::encode($model->title);?></a></h2>

            <div class="entry-meta">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?= date('Y-m-d H:i',$model->created_at)."&nbsp;&nbsp;&nbsp;&nbsp;" ; ?></em>
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?= Html::encode($model->user->username)."&nbsp;&nbsp;&nbsp;&nbsp;" ; ?></em>
                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <em><?= Html::a(" {$model->commentCount}条评论",$model->url.'#comments'); ?></em>
            </div>
        </div>
        <br>
        <div class="entry-summary">

            <?= $model->content; ?>

            <?/*= HtmlPurifier::process($model->content) */?>

        </div>

        <br>

        <div class="nav">
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            <?= implode(', ', $model->tagLinks); ?>
            <br/>
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            最后修改于 <?= date('Y-m-d H:i:s',$model->updated_at); ?>
        </div>

        <div id="comments">

            <?php if($added) {?>

                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4>谢谢您的回复，我会尽快审核后将其展现出来！</h4>
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object" src="img/none.png" alt="<?= Html::encode($postModel->author) ; ?>" style="width: 64px; height: 64px;" data-holder-rendered="true" aria-hidden="true">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?= Html::encode($postModel->author) ; ?>:</h4>
                            <p class="glyphicon glyphicon-time" aria-hidden="true"></p> <em><?= date('Y-m-d H:i:s',$postModel->created_at); ?></em>
                            <p class="reply-content"><?php echo nl2br($postModel->content); ?></p>
                        </div>
                    </div>
                </div>

            <?php }?>

            <?php if($model->commentCount>=1): ?>
                <h5 class="reply-count">
                    <?php echo $model->commentCount . '条评论'; ?>
                </h5>

                <?php echo $this->render('comment',array(
                    'post'=>$model,
                    'comments'=>$model->comments,
                )); ?>
                <?php else: echo '暂无评论';?>
            <?php endif; ?>


            <h5 class="reply-title">发表评论</h5>
            <?php
            $postComment = new Comment();
            echo $this->render('form',array(
                'id'=>$model->id,
                'postModel'=>$postComment,
            )); ?>

        </div>

    </div>
</div>

<div class="content-right">

    <aside class="widget-content">
        <h1 class="widget-title glyphicon glyphicon-tags"> 标签云</h1>
        <ul class="widget-list">
            <?= TagCloud::widget(['tags' => $tags]); ?>
        </ul>
    </aside>

    <aside class="widget-content">
        <h1 class="widget-title glyphicon glyphicon-upload"> 最近发表</h1>
        <ul class="widget-list">
            <?= RecentPosts::widget(['postDataProvider' => $postDataProvider]); ?>
        </ul>
    </aside>

    <aside class="widget-content">
        <h1 class="widget-title glyphicon glyphicon-comment"> 最新评论</h1>
        <ul class="widget-list">
            <?= RecentComments::widget(['commentDataProvider' => $commentDataProvider]); ?>
        </ul>
    </aside>

    <aside class="widget-content">
        <h1 class="widget-title glyphicon glyphicon-list"> 分类列表</h1>
        <ul class="widget-list">
            <?= CateList::widget(['cateDataProvider' => $cateDataProvider]); ?>
        </ul>
    </aside>

</div>
