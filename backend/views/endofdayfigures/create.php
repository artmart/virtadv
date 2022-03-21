<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Endofdayfigures */

$this->title = 'Create Endofdayfigures';
$this->params['breadcrumbs'][] = ['label' => 'Endofdayfigures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="endofdayfigures-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
