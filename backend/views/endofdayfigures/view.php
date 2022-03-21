<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;

$this->title = $model->timestamp;
$this->params['breadcrumbs'][] = ['label' => 'End of day figures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\yii\web\YiiAsset::register($this);
?>
<div class="endofdayfigures-view">
<?php /*    <h1 class="float-left"><?= Html::encode($this->title) ?></h1>
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
    <div class="clearfix"></div> */ ?>
    <hr />
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            ['attribute' => 'user_id',  'label' =>'User', 'value' => function($model){
                $user = User::find()->where(['id' =>$model->user_id])->one();
                return $user->firstname.' '.$user->lastname;
                }
            ],
            'timestamp',
            'just_eat_total_orders',
            'just_eat_total_sales',
            'uber_eats_total_orders',
            'uber_eats_total_sales',
            'deliveroo_total_orders',
            'deliveroo_total_sales',
            'wix_total_orders',
            'wix_total_sales',
            'zettle_total_orders',
            'zettle_total_sales',
        ],
    ]) ?>

</div>
