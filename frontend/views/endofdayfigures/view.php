<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->timestamp;
//$this->params['breadcrumbs'][] = ['label' => 'Endofdayfigures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="endofdayfigures-view">
   <?php /* <h1 class="float-left"><?= Html::encode($this->title) ?></h1> */ ?>
    <p class="float-right">
        <?= Html::a('Update', ['endofdayfigures/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post'],
        ]) */ ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'timestamp',
            'just_eat_total_orders',
            'just_eat_total_sales',
            'uber_eats_total_orders',
            'uber_eats_total_sales',
            'deliveroo_total_orders',
            'deliveroo_total_sales',
            'wix_total_orders',
            'wix_total_sales',
            'zettle_total_orders',
            'zettle_total_sales',
        ],
    ]) ?>
</div>