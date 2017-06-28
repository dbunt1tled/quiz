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
use app\models\Users;
use app\models\Quiz;
class Highscore extends ActiveRecord{

    public static function tableName()
    {
        return 'highscore';
    }
    public function rules()
    {
        return [
            // username and password are both required
            ['score', 'required'],
            ['user', 'required'],
            ['quiz', 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'score' => 'Score',
            'quiz' => 'Quiz',
            'user' => 'User',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(Users::className(), ['user' => 'id']);
    }
    public function getQuizes() {
        return $this->hasMany(\app\models\Quiz::className(), ['quiz' => 'id']);
    }
}
