<?php
/**
 * Created by PhpStorm.
 * User: sid
 * Date: 27.06.2017
 * Time: 21:42
 */
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Users */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Create New Qiuz';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create quiz:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'quiz-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-8\">{label}</div>\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-11">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'quiz-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>