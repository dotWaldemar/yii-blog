<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'date')->textInput() ?>
        <?= $form->field($model, 'image')->fileInput(['maxlength' => true, 'required' => true]) ?>
        <?= $form->field($model, 'category')->dropDownList($categories, ['class' => 'form-control']) ?>
        <?= $form->field($model, 'tags')->checkboxList($tags) ?>
        <?php //var_dump($tags);die; ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
