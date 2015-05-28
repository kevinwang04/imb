<?php
/**
 * Created by PhpStorm.
 * User: ljm
 * Date: 2015/4/8
 * Time: 21:49
 */

class UserController extends Controller{
    const DAY_TIMESTAMP = 86400;        //一整天的时间戳

    public function actionIndex(){
        $users = UserModel::model()->findAll();
        $this->render('index', array(
            'users'=>$users
        ));
    }

    public function actionLogin(){
        $result = true;
        $returnCode = ReturnCode::RETURN_CODE_SUCCESS;
        $resp = null;
        if(!empty($_POST)){
            $uuid = $_POST['uuid'];
            if($uuid == null){
                $result = false;
                $returnCode =ReturnCode::RETURN_CODE_PARAMETER_EMPTY;
                $count = 0;
            }else {
                $user = UserModel::model()->find('uuid=:uuid', array(':uuid' => $uuid));
                if ($user != null) {
                    $loginTimeOld = $user->login_time;
                    $loginTime = time();
                    $count = intval(($loginTime - $loginTimeOld) / DAY_TIMESTAMP);
                    $result = true;
                    $returnCode = ReturnCode::RETURN_CODE_SUCCESS;
                } else {      //新用户
                    $user = new UserModel();
                    $user->uuid = $uuid;
                    $user->login_time = time();
                    $user->user_info = '';
                    $user->ustatus = UserModel::USER_STATUS_ENABLE;
                    if ($user->save()) {
                        $result = true;
                        $returnCode = ReturnCode::RETURN_CODE_SUCCESS;
                        $count = 1;
                    } else {      //插入失败
                        $result = false;
                        $returnCode = ReturnCode::RETURN_CODE_DB_EXCEPTION;
                        $count = 0;
                    }
                }
            }

            $resp = array(
                'result'=>$result,
                'returnCode'=>$returnCode,
                'message'=>array(
                    'frequency'=>$count,
                ));
            echo CJSON::encode($resp);
        }else{
            throw new CHttpException(403, 'Access Forbidden!');
        }
    }

    public function actionDelete(){
        $rtn = -1;
        if(!empty($_POST)){
            $user_id = $_POST['user']['user_id'];
            if($user_id == null){
                throw new CHttpException(500, 'Internal Error!');
            }
            $rtn = UserModel::model()->deleteByPk($user_id);
            if($rtn > ReturnCode::RETURN_CODE_DB_ERROR){
                $users = UserModel::model()->findAll();
                echo CJSON::encode($users);
            }
        }else{
            throw new CHttpException(403, 'Access Forbidden!');
        }
    }
}