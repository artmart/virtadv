<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

use backend\models\Sp500rates;

$this->title = 'S&P 500 Rates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sp500rates-index">
<div class="row">
    <h1 class="col-sm-9"><?= Html::encode($this->title) ?></h1>
    <p class="col-sm-3 d-flex justify-content-end">
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Add S&P 500 rates', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
<hr />
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'year',
            'return',
            //'january',
            //'february',
            //'march',
            //'april',
            //'may',
            //'june',
            //'july',
            //'august',
            //'september',
            //'october',
            //'november',
            //'december',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Sp500rates $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
