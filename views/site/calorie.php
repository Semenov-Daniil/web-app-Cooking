<?php

use app\models\Composition;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CompositionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Калорийность одной порции блюда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'title',
                'label' => 'Название блюда',
            ],
            [
                'attribute' => 'calorie',
                'label' => 'Калорийность',
            ],
        ]
    ]); ?>


</div>
