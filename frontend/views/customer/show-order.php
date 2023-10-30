<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Customer Orders';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $data,
    ]),
    'columns' => [
        'id',
        'nama',
        'date',
        'name',
        'price',
        'category_name',
    ],
]) ?>
