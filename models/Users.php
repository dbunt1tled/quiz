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

class Users extends ActiveRecord{

    public $confirm;



    public static function tableName()
    {
        return 'users';
    }
    public function rules()
    {
        return [
            // username and password are both required
            /*['username', 'required'],
            ['password', 'required'],
            ['confirm', 'string', 'max' => 64],/**/
              [['username', 'password', 'confirm'], 'required', 'on'=>'signup'],
              [['username', 'password'], 'required', 'on'=>'login'],
              ['confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"пароли не совпадают"],/**/


        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Пользователь',
            'password' => 'Пароль',
            'confirm' => 'Пароль снова',
        ];
    }
    public function loginUser($id){
        $session = Yii::$app->session;
        $session->set('isLogin', $this->username);
        $session->set('userLoginId', $id);
    }
    public static function isUserLogin(){
        if(isset(Yii::$app->session['isLogin'])){
            return true;
        }
        return false;
    }
    public function logOut(){
        if(isset(Yii::$app->session['isLogin'])){
            Yii::$app->session->destroy();
        }
    }
    public function getHighscories() {
        return $this->hasMany(\app\models\Highscore::className(), [ 'id' => 'user']);
    }

}
