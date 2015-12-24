<?php
/**
 * Created by PhpStorm.
 * User: 慕虚云
 * Date: 2015/12/15 0015
 * Time: 22:35
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div id="respond">

    <?php
    $form = ActiveForm::begin([
        'action' => ['home/detail','id' => $id, '#' => 'comments'],
        'method'=>'post',
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($postModel, 'author')->textInput(['maxlength' => 32]) ?>
        </div>
        <div class="col-md-4 block">
            <?= $form->field($postModel, 'email')->textInput(['maxlength' => 32]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"><?= $form->field($postModel, 'content')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($postModel->isNewRecord ? '发表评论' : '修改评论', ['class' => $postModel->isNewRecord ? 'btn btn-default' : 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>