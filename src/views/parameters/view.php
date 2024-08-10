<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Parameter */

$this->title = $model->title;
?>
<div class="parameter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <ul>
        <li><strong>Title:</strong> <?= Html::encode($model->title) ?></li>
        <li><strong>Type:</strong> <?= Html::encode($model->type) ?></li>
        <li><strong>Icon:</strong> <?= $model->icon ? Html::img($model->getIconUrl(), ['width' => '50px']) : 'No icon' ?></li>
        <li><strong>Icon Gray:</strong> <?= $model->icon_gray ? Html::img($model->getIconGrayUrl(), ['width' => '50px']) : 'No icon' ?></li>
    </ul>

</div>
