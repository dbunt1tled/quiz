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
class Quiz extends ActiveRecord{

    public $count;

    public static function tableName()
    {
        return 'quiz';
    }
    public function rules()
    {
        return [
            // username and password are both required
            ['name', 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Quiz Name',
            'count' => 'Question Count',

        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions() {
        return $this->hasMany(\app\models\Question::className(), ['quiz' => 'id']);
    }

    public function getHighscories() {
        return $this->hasMany(\app\models\Highscore::className(), ['quiz' => 'id']);
    }
}
