<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Status;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::button('发布文章', ['value'=>Url::to('index.php?r=post/create'), 'class' => 'btn btn-success','id'=>'modalButton']) */?>
    </p>-->

    <p>
        <?= Html::a('发布文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        Modal::begin([
                'header' => '<h4>新建文章</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
            ]);
        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>

    <?php /*Pjax::begin(); */?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'content:ntext',
            'tags',
            [
                'attribute'=>'user_id',
                'value'=>function ($model) {
                    return $model->user->username;
                },
            ],
            [
                'attribute'=>'cate_id',
                'value'=>function ($model) {
                    return $model->cate->title;
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->status === Status::STATUS_ACTIVE) {
                        $class = 'label-success';
                    } elseif ($model->status === Status::STATUS_INACTIVE) {
                        $class = 'label-warning';
                    } else {
                        $class = 'label-danger';
                    }
                    return '<span class="label ' . $class . '">' . $model->getStatus()->label . '</span>';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    Status::labels(),
                    ['class' => 'form-control', 'prompt' =>'']
                )
            ],
            'created_at:datetime',
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {approve} {delete}',
                'buttons' => [
                    // 自定义按钮
                    'approve' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', '激活'),
                            'aria-label' => Yii::t('yii', '激活'),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php /*Pjax::end(); */?>

</div>
