<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\db\search\BidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bids';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bid-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $form = \yii\widgets\ActiveForm::begin();
        echo $form->field($searchModel, 'search_field_main')->textInput(['placeholder' => 'Search by id, price']);

        echo $form->field($searchModel, 'search_field_additional')->textInput(['placeholder' => 'Search by description']);

        echo $this->render('../parts/dateTimeWidget', ['model' => $searchModel, 'modelName' => 'search_field_date']);
        echo Html::submitButton('Search', ['class' => 'btn btn-primary']);
    $form->end();
    ?>

    <br>
<p>
<?= Html::a('Create Bid', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?= $this->render('../parts/bid_grid_view', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]) ?>
</div>
