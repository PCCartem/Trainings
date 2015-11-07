<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site">
<h1>Добро пожаловать!</h1>
<h3>Список страниц:</h3>

    <div class="body-content">
        <?php $form = ActiveForm::begin(['id' => 'edit-form']); ?>
    
<?= $form->field($model, 'alias') ?>

<?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
    </div>
</div>
