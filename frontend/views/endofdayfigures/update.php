<?php
use yii\helpers\Html;

$this->title = 'Update End of day figure: ' . $model->timestamp;
//$this->params['breadcrumbs'][] = ['label' => 'Endofdayfigures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="endofdayfigures-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr />
    <?= $this->render('_form', ['model' => $model, 'update'=>1]) ?>
</div>