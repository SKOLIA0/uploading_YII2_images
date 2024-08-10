<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Parameter */

$this->title = 'Update Parameter: ' . $model->title;
?>
<div class="parameter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="parameter-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'type')->dropDownList([1 => 'Type 1', 2 => 'Type 2']) ?>

        <?= $form->field($model, 'icon')->fileInput() ?>
        <?php if ($model->icon): ?>
            <?= Html::img($model->getIconUrl(), ['width' => '100px']) ?>
            <?= Html::a('Удалить', ['delete-image', 'id' => $model->id, 'type' => 'icon'], ['class' => 'btn btn-danger']) ?>
        <?php endif; ?>

        <?= $form->field($model, 'icon_gray')->fileInput() ?>
        <?php if ($model->icon_gray): ?>
            <?= Html::img($model->getIconGrayUrl(), ['width' => '100px']) ?>
            <?= Html::a('Удалить', ['delete-image', 'id' => $model->id, 'type' => 'icon_gray'], ['class' => 'btn btn-danger']) ?>
        <?php endif; ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
