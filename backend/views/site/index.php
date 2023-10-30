<?php
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>

<style>
    .product-image {
        width: 100%;
        height: 200px;
    }

    /* Customize the filter buttons */
    .btn-group button {
        margin: 5px;
    }

    .btn-group button.active {
        background-color: #337ab7;
        color: #fff;
    }

    ul.pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    ul.pagination li {
        margin: 5px;
    }

    ul.pagination li a {
        text-decoration: none;
        padding: 5px 10px;
        background-color: #337ab7;
        color: #fff;
        border: 1px solid #337ab7;
        border-radius: 5px;
    }

    ul.pagination li a:hover {
        background-color: #235a92;
        border: 1px solid #235a92;
    }
</style>


<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4 mb-4">Welcome to our Store!</h1>
    </div>

    <div class="body-content">
    <div class="col-md-12">
    <label for="category-filter">Filter by Category:</label>
    <div id="category-buttons" class="btn-group" role="group" aria-label="Category Buttons">
        <button type="button" class="btn btn-secondary" data-category="">All</button>
        <?php foreach ($categories as $category): ?>
            <button type="button" class="btn btn-secondary" data-category="<?= $category['id'] ?>">
                <?= Html::encode($category['name']) ?>
            </button>
        <?php endforeach; ?>
    </div>
</div>
<div class="row product-list">
    <?php foreach ($dataProvider->getModels() as $model): ?>
        <div class="col-md-4 product-card" data-category="<?= Html::encode($model['category_id']) ?>">
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
    <?php endforeach; ?>
</div>

<div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'pagination'],
                'layout' => '{pager}',
            ]);
            ?>
        </div>
    </div>

    </div>
</div>

<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        // Inisialisasi filter
        $('#category-buttons button').on('click', function () {
            // hilangkan catatan jika ada
            $('.product-list .col-md-12').remove();
            var selectedCategory = $(this).data('category');

            // Remove the 'active' class from all buttons
            $('#category-buttons button').removeClass('active');

            // Add the 'active' class to the clicked button
            $(this).addClass('active');

            // Jika tidak ada category yang dipilih, tampilkan semua item
            if (selectedCategory === '') {
                $('.product-card').show();
            } else {
                // Sembunyikan semua item
                $('.product-card').hide();

                // jika tidak ada item yang sesuai dengan category yang dipilih, tampilkan catatan
                if ($('.product-card[data-category="' + selectedCategory + '"]').length === 0) {
                    // buat satu card besar dengan tulisan di tengah card
                    var card = $('<div class="col-md-12"><div class="card mb-4 box-shadow"><div class="card-body"><p class="card-text">No items found for this category.</p></div></div></div>');

                    // tambahkan card ke dalam row
                    $('.product-list').append(card);
                }

                // Tampilkan item yang sesuai dengan category yang dipilih
                $('.product-card[data-category="' + selectedCategory + '"]').show();
            }
        });
    });
</script>
