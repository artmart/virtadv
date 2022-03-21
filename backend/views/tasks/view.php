<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->task;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">
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
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'task_group',
            [
                'attribute' => 'task_group',
                'format' => 'raw',
                'value'=>  function($data) {
                    $arr = ['0' => 'Pre Opening', '1' => 'Prep', '2' => 'Closing '];
                    return $arr[$data->task_group];
                    },  
            ],
            [
                'attribute' => 'status',
                 'format' => 'raw',
                'value'=>  function($data) {return ($data->status==1)?'Active':'Inactive';}, 
            ],
            'task',
            'note',
        ],
    ]) ?>
</div>