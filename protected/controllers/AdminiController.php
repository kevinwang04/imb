<?php
/**
 * Created by PhpStorm.
 * User: ljm
 * Date: 2015/4/8
 * Time: 21:40
 */

class AdminiController extends Controller{

    public function actionLogin(){

    }

    public function actionIndex(){
        $this->render('index');
    }

    //错误输出
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
}