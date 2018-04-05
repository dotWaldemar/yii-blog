<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength' => true, 'required' => true]) ?>
    
    <?= $form->field($model, 'category')->dropDownList($categories, ['class' => 'form-control']) ?>
    
    <?php echo $form->checkBox($model,'label_name',array('value'=>1,'uncheckValue'=>0,'checked'=>($model->id=="")?true:$model->label_name),'style'=>'margin-top:7px;')); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
