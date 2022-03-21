<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Endofdayfigures;
use backend\models\User;
use yii\helpers\ArrayHelper;

$this->title = 'End of day figures';
$this->params['breadcrumbs'][] = $this->title;

$users =  ArrayHelper::map(User::find()->asArray()->all(), 'id', 'firstname');
?>
<div class="endofdayfigures-index">
    <h1 class="float-left"><?= Html::encode($this->title) ?></h1>
    <p class="float-right">
        <?php // Html::a('<i class="fa fa-plus" aria-hidden="true"></i>  Add', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="clearfix"></div>
    <hr />
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'user_id',
            ['attribute' => 'user_id',  'label' =>'User', 
            'filter'=>$users,
            'value' => function($model)use ($users){
                //$user = User::find()->where(['id' =>$model->user_id])->one();
                return $users[$model->user_id];
                }
            ],
            'timestamp',
            'just_eat_total_orders',
            'just_eat_total_sales',
            'uber_eats_total_orders',
            //'uber_eats_total_sales',
            //'deliveroo_total_orders',
            //'deliveroo_total_sales',
            //'wix_total_orders',
            //'wix_total_sales',
            //'zettle_total_orders',
            //'zettle_total_sales',
            [
                'class' => ActionColumn::className(), 'template' => '{view}', //{delete}
                'urlCreator' => function ($action, Endofdayfigures $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>