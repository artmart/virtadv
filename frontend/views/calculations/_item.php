<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>  

<?php //$model->reference_id;?> 
<?php //$model->id;?> 
<?= Html::a(Html::encode($model->reference_id), Url::toRoute(['calculations/update', 'id' => $model->id]), ['title' => $model->reference_id]) ?>