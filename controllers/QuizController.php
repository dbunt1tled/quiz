<?php
/**
 * Created by PhpStorm.
 * User: sid
 * Date: 27.06.2017
 * Time: 19:29
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Quiz;
use app\models\Question;
use app\models\Highscore;
use yii\data\ActiveDataProvider;
class QuizController extends Controller
{

    public function actionCreate() {
        $model = new Quiz();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->count = Yii::$app->request->post('Quiz');
            $model->count = $model->count['count'];

            $quizId = $model->getPrimaryKey();
            $rows=[];
            for($i=1;$i<=$model->count;$i++){
                $numAnswers = rand(2, 5);
                $num_let = rand(0,1);
                $trueAnswer = rand(1, $numAnswers);
                $rows[]=[$quizId,$i,$numAnswers,$trueAnswer,$num_let];
            }
            Yii::$app->db->createCommand()->batchInsert(Question::tableName(), ['quiz','name','count','answer','num_let'], $rows)->execute();
            return $this->redirect(['quiz/index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionIndex() {
        $query = Quiz::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id) {
        $model = $this->findModel($id);
        $post  = Yii::$app->request->post();
        if ($post) {

           $questionsPost=$post['quiz'];
           $countAll=0;
           $countTrue=0;

           foreach ($model->questions as $question){
                if((isset($questionsPost[$question->name])) && ($questionsPost[$question->name]==$question->answer)  ){
                    $countTrue++;
                }
                $countAll++;
           }
            $highscore = Highscore::findOne(['user' => Yii::$app->session['userLoginId'], 'quiz' => $id]);

            if(is_null($highscore)){
                $highscore = new Highscore();
            }
            $highscore->score = ceil($countTrue / $countAll) * 100;
            $highscore->user = Yii::$app->session['userLoginId'];
            $highscore->quiz = $id;
            if ($highscore->validate()&& $highscore->save()) {
                return $this->redirect(['quiz/index']);
            }else{
                return $this->refresh();
            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
    protected function findModel($id) {
        if(($model = Quiz::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Quiz not found.');
        }
    }
}
