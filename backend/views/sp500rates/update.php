<?php
use yii\helpers\Html;

$this->title = 'S&P 500 Rates: YEAR ' . $model->year;
$this->params['breadcrumbs'][] = ['label' => 'S&P 500 Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->year, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sp500rates-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr />
    <?= $this->render('_form', ['model' => $model]) ?>
</div>