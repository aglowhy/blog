<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Cate;
use common\models\Status;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'content')->widget('kucha\ueditor\UEditor',[]) ?>

    <?= $form->field($model, 'tags')->textInput() ?>

    <?= $form->field($model, 'cate_id')->dropDownList(Cate::getAllCate()) ?>

    <?= $form->field($model, 'status')->dropDownList(Status::labels()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '发 布' : '修 改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
