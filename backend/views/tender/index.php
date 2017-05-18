<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\db\search\TenderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $form = \yii\widgets\ActiveForm::begin();
        echo $form->field($searchModel, 'search_field_main')->textInput(['placeholder' => 'Search by id, name']);

        echo $form->field($searchModel, 'search_field_additional')->textInput(['placeholder' => 'Search by description, price']);

        echo $this->render('../parts/dateTimeWidget', ['model' => $searchModel, 'modelName' => 'search_field_date']);
        echo Html::submitButton('Search', ['class' => 'btn btn-primary']);
    $form->end();
    ?>

    <br>
    <p>
        <?= Html::a('Create Tender', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'price',
            'begin_time',
            // 'end_time',
            // 'company_id',
            // 'winner_bid_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
