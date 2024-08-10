<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Parameter */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create Parameter';
?>
<div class="parameter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="parameter-form">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'type')->dropDownList([1 => 'Type 1', 2 => 'Type 2']) ?>

        <?= $form->field($model, 'iconFile')->fileInput() ?>

        <?= $form->field($model, 'iconGrayFile')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
