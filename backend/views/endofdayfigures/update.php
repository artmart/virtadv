<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Endofdayfigures */

$this->title = 'Update Endofdayfigures: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Endofdayfigures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="endofdayfigures-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
