<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\Bid */

$this->title = 'Update Bid: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bid-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'company_list' => $company_list,
        'tender_list' => $tender_list,
    ]) ?>

</div>
