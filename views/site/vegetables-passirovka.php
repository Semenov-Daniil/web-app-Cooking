<?php

use yii\helpers\Html;
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

    <?=Html::a('Экспорт1', ['site/export1'], ['class' => 'btn btn-primary']);?>
    <?=Html::a('Экспорт2', ['site/export2'], ['class' => 'btn btn-primary']);?>


</div>
