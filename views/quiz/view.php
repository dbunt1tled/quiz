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
use yii\grid\GridView;
use app\models\Question;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = 'Take the quiz '.$model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .btn-group-lg .btn,.btn-toolbar> .btn{
             border-radius: 50%;
             background-color: #fff;
             border: 2px solid #dddddd;
             color: #dddddd;
             margin: 10px;
             width: 50px;
             height: 50px;
         }
    .btn-toolbar> .btn{
        font-size: 40px;
        line-height: 35px;
        color: #000;
        border: none;
    }
    .btn:active, .btn.active{
        background-color: #d4d4d4;
        border-color: #8c8c8c;
        color: #333;
    }
</style>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choice true answers:</p>
    <?php $form = ActiveForm::begin([
    'action' => Url::to(['view', 'id' => $model->id])
    ]); ?>
    <?php  foreach ($model->questions as $question): ?>
        <div class="btn-toolbar">
                <button class="btn"><?= $question->name ?></button>

                <div class="btn-group-lg" data-toggle="buttons">

                <?php  for($i=1;$i<=$question->count;$i++){ ?>

                        <label class="btn btn-default">

                            <input type="radio" id="quiz-<?= $question->name ?>-<?= $i ?>" name="quiz[<?= $question->name ?>]" value="<?= $i ?>" /> <?= $question->num_let ? $i : chr($i+64) ?>
                        </label>

                <?php } ?>
                </div>
        </div>
    <?php endforeach; ?>
        <?= Html::submitButton('Save and finish', ['class' => 'btn btn-primary', 'name' => 'send-button']) ?>
    <?php ActiveForm::end(); ?>
</div>