<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\RecentPosts;
use frontend\widgets\RecentComments;
use frontend\widgets\TagCloud;
use frontend\widgets\CateList;

$this->title = 'PHP Study Notes';

?>
<div class="content-left">

    <?= ListView::widget([
        'id' => 'postList',
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
        'layout'=>'{items}<div align=\'center\'>{pager}</div>',
        'pager'=>[
            'maxButtonCount'=>10,
            'nextPageLabel'=>Yii::t('app','下一页'),
            'prevPageLabel'=>Yii::t('app','上一页'),
        ],
    ]);
    ?>

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
