<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\Tender */

$this->title = 'Update Tender: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tender-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'bids_list' => $bids_list,
        'company_list' => $company_list,
    ]) ?>

</div>
