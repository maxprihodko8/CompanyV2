<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\Tender */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'id',
            'name',
            'description',
            'price',
            'begin_time',
            'end_time',
            'company_id',
            'winner_bid_id',
        ],
    ]) ?>

    <h1><?= "Bids for tender" ?></h1>


    <?= $this->render('../parts/bid_grid_view', ['searchModel' => $searchModelBid, 'dataProvider' => $dataProviderBid]) ?>


</div>
