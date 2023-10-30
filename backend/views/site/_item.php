<?php
use yii\helpers\Html;
$this->title = 'My Yii Application';
?>

<div class="col-md-4">
    <!-- Konten item -->
    <div class="card mb-4 box-shadow">
        <img src="<?= Yii::getAlias('@web') . '/uploads/' . $model['gambar'] ?>" class="card-img-top product-image" alt="<?= Html::encode($model['name']) ?>">
        <div class="card-body">
            <h5 class="card-title"><?= Html::encode($model['name']) ?></h5>
            <p class="card-text"><?= Html::encode($model['category_name']) ?></p>
            <p class="card-text">Price: $<?= Html::encode($model['price']) ?></p>
            <?php if (!Yii::$app->user->isGuest): ?>
                <?= Html::a('Buy', ['purchase/buy', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>
        </div>
    </div>
</div>


