<?php

use app\models\Composition;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CompositionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Первое блюдо';
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
                'attribute' => 'dishes_category',
                'label' => 'Категория блюда',
            ],
            [
                'attribute' => 'products_title',
                'label' => 'Название продукта',
            ],
            [
                'attribute' => 'priority',
                'label' => 'Очередность добавления',
            ],
        ]
    ]); ?>

    <?=Html::a('Экспорт1', ['site/export1', 'title' => 'first_dishes'], ['class' => 'btn btn-primary']);?>
    <?=Html::a('Экспорт2', ['site/export2', 'title' => 'first_dishes'], ['class' => 'btn btn-primary']);?>


</div>
