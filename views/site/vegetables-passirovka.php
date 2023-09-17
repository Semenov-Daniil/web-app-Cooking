<?php

use app\models\Composition;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CompositionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Блюда с пассировкой овощей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="composition-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'dishes_title',
                'label' => 'Название блюда',
            ],
            [
                'attribute' => 'products_title',
                'label' => 'Название продукта',
            ],
            [
                'attribute' => 'category',
                'label' => 'Категория продукта',
            ],
            [
                'attribute' => 'pre_processing',
                'label' => 'Предварительная обработка продутка',
            ]
        ]
    ]); ?>


</div>
