<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\db\Bid */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="bid-form">


    <?= Yii::$app->session->getFlash('error') ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_id')->dropDownList($company_list ? $company_list : []) ?>

    <?= $form->field($model, 'tender_id')->dropDownList($tender_list ? $tender_list : []) ?>

    <p>
    <?= $this->render('../parts/dateTimeWidget', ['model' => $model, 'modelName' => 'begin_time']) ?>
    </p>
    <p>
    <?= $this->render('../parts/dateTimeWidget', ['model' => $model, 'modelName' => 'end_time']) ?>
    </p>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
