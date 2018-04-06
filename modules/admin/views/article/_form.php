<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use dosamigos\datepicker\DatePicker;
?>

<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        <?= DatePicker::widget([
            'model' => $model,
            'name' => 'date',
            'attribute' => 'date',
            'template' => '{addon}{input}',
                'clientOptions' => [
                    'autoclose' => true,
                    'value' => $model->date,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
        ]);?>
        <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>
        <img src="/uploads/<?= $model->image ?>" alt="" width="200">
        
        <?= $form->field($model, 'category')->dropDownList($categories, ['class' => 'form-control']) ?>
        <?= $form->field($model, 'tags')->checkboxList($tags) ?>
        <?php //var_dump($tags);die; ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
