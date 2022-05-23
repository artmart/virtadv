<?php
use yii\helpers\Html;

$this->title = 'Add S&P 500 Rrate';
$this->params['breadcrumbs'][] = ['label' => 'S&P 500 Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sp500rates-create">

    <h1><?= Html::encode($this->title) ?></h1>
<hr />
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
