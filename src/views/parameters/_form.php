<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Parameter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parameter-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList([1 => 'Type 1', 2 => 'Type 2']) ?>

    <?php if ($model->type == 2): ?>
        <?= $form->field($model, 'iconFile')->fileInput() ?>
        <?= $form->field($model, 'iconGrayFile')->fileInput() ?>

        <?php if ($model->icon): ?>
            <p>Текущее изображение Icon: <?= Html::img($model->getIconUrl(), ['width' => '100px']) ?></p>
            <p>Оригинальное имя файла: <?= Html::encode($model->icon_original_name) ?></p>
        <?php endif; ?>

        <?php if ($model->icon_gray): ?>
            <p>Текущее изображение Icon Gray: <?= Html::img($model->getIconGrayUrl(), ['width' => '100px']) ?></p>
            <p>Оригинальное имя файла: <?= Html::encode($model->icon_gray_original_name) ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
