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
use app\models\Users;


class UsersController extends Controller
{

    public function actionRegister()
    {
        $model = new Users();
        $model->setScenario('signup');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->password === $model->confirm){
                /*$model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);/**/
                if($model->save()){
                    return $this->redirect(['users/login']);
                } else {
                    return $this->refresh();
                }
            }else{
                throw new NotFoundHttpException('Password not confirm');
            }

        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    public function actionLogin(){

        if(empty(Yii::$app->session['isLogin'])){
            $model = new Users();
            $model->setScenario('login');
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = Users::find()->where(["username" => $model->username ])->asArray()->all();

                //echo Yii::$app->getSecurity()->generatePasswordHash($model->password);"<br>";
                /*if(Yii::$app->getSecurity()->validatePassword($model->password, $user[0]['password'])){/**/


                if($model->password == $user[0]['password']){
                    $model->loginUser($user[0]['id']);
                    return $this->redirect(['quiz/index']);
                } else {
                    Yii::$app->session->setFlash('password', 'Username or Password is invalid.');
                }
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionLogout(){
        Users::logOut();
        return $this->redirect(['users/login']);
    }
}
