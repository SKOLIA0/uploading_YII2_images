<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParameterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parameters';
?>
<div class="parameters-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Parameter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'type',
            [
                'attribute' => 'icon',
                'format' => 'html',
                'value' => function($model) {
                    return $model->icon ? Html::img($model->getIconUrl(), ['width' => '50px']) : null;
                }
            ],
            [
                'attribute' => 'icon_gray',
                'format' => 'html',
                'value' => function($model) {
                    return $model->icon_gray ? Html::img($model->getIconGrayUrl(), ['width' => '50px']) : null;
                }
            ],
            'icon_original_name',
            'icon_gray_original_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
