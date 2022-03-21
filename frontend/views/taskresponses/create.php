<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Taskresponses */

$this->title = 'Create Taskresponses';
$this->params['breadcrumbs'][] = ['label' => 'Taskresponses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taskresponses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
