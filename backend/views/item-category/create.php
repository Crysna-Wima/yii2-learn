<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ItemCategory $model */

$this->title = 'Create Item Category';
$this->params['breadcrumbs'][] = ['label' => 'Item Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
