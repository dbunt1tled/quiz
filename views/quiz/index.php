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
use app\models\Highscore;
$this->title = 'List of the quizes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choice quiz:</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => [],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'count',
                'value' => function ($model) {
                    return Question::find()->where(['quiz' => $model->id])->count();
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'Actions',
                'value' => function ($model) {
                    return Html::a(Html::encode("Take the quiz"), Url::to(['view', 'id' => $model->id]),['class' => ['btn', 'btn-primary']]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'Score (%)',
                'value' => function ($model) {
                    $highscore = Highscore::find()->where(['user' => Yii::$app->session['userLoginId'], 'quiz' => $model->id])->one()->score;
                    if (!is_null($highscore)) {
                        return $highscore;
                     }
                     return "Don't pass";
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>

</div>