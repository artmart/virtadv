<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EndofdayfiguresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Endofdayfigures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="endofdayfigures-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Endofdayfigures', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'timestamp',
            'just_eat_total_orders',
            'just_eat_total_sales',
            //'uber_eats_total_orders',
            //'uber_eats_total_sales',
            //'deliveroo_total_orders',
            //'deliveroo_total_sales',
            //'wix_total_orders',
            //'wix_total_sales',
            //'zettle_total_orders',
            //'zettle_total_sales',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Endofdayfigures $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
