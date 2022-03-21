<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Productgroups;

$this->title = 'Product Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productgroups-index">
    <h1 class="float-left"><?= Html::encode($this->title) ?></h1>
    <p class="float-right">
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i>  Add', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="clearfix"></div>
    <hr />
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'product_group',
            //'status',
            [
                'attribute' => 'status',
                'filter'=>['1' => 'Active', '0' => 'Inactive'],
                 'format' => 'raw',
                'value'=>  function($data) {return ($data->status==1)?'Active':'Inactive';}, 
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Productgroups $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>