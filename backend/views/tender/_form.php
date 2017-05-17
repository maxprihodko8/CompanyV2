<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\Tender */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tender-form">
    <?= Yii::$app->session->getFlash('error') ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <p>
        <?= $this->render('../parts/dateTimeWidget', ['model' => $model, 'modelName' => 'begin_time']) ?>
    </p>
    <p>
        <?= $this->render('../parts/dateTimeWidget', ['model' => $model, 'modelName' => 'end_time']) ?>
    </p>

    <?= $form->field($model, 'company_id')->dropDownList($company_list ? $company_list : []) ?>

    <?= $form->field($model, 'winner_bid_id')->dropDownList($bids_list ? $bids_list : []) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
