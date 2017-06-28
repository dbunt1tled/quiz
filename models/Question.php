<?php
/**
 * Created by PhpStorm.
 * User: sid
 * Date: 27.06.2017
 * Time: 18:01
 */
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Quiz;
class Question extends ActiveRecord{

    public static function tableName()
    {
        return 'question';
    }
    public function rules()
    {
        return [
            // username and password are both required
            ['name', 'required'],
            ['quiz', 'required'],
            ['count', 'required'],
            ['answer', 'required'],
            ['num_let', 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Name Question',
            'quiz' => 'Quiz',
            'count' => 'Count Answers',
            'answer' => 'True Answer',
            'num_let' => 'Render Answers',
        ];
    }
    public function getQuiz() {
        return $this->hasOne(Quiz::className(), ['id' => 'qiuz']);
    }
}
