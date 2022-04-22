<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\Calculations;

$this->title = 'Saved Calculations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calculations-index">
<div class="container d-inline-block">
    <h1 class="float-left"><?= Html::encode($this->title) ?></h1>
    <p class="float-right">
        <?= Html::a('New Calculation', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'user_id',
            'reference_id',
            'current_value',
            'years_of_investment',
            //'annual_return_rate',
            //'annual_withdrawal',
            //'management_fee',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Calculations $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>