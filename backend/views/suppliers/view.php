<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->supplier;
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\yii\web\YiiAsset::register($this);
?>
<div class="suppliers-view">
    <h1 class="float-left"><?= Html::encode($this->title) ?></h1>
    <p class="float-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="clearfix"></div>
    <hr />
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'supplier',
            [
                'attribute' => 'status',
                 'format' => 'raw',
                'value'=>  function($data) {return ($data->status==1)?'Active':'Inactive';}, 
            ],
        ],
    ]) ?>
</div>