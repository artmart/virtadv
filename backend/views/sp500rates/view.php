<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'S&P 500 rates: YEAR '. $model->year;
$this->params['breadcrumbs'][] = ['label' => 'S&P 500 rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sp500rates-view">
    <h1><?= Html::encode($this->title) ?></h1>
<hr />
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'year',
            'return',
            'january',
            'february',
            'march',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december',
        ],
    ]) ?>

</div>
