<?php
/**
 * Created by PhpStorm.
 * User: ljm
 * Date: 2015/4/8
 * Time: 21:48
 */

class ManagerController extends Controller{
    public function actionIndex(){
        $managers = ManagerModel::model()->findAll();
        $this->render('index', array(
            'managers'=>$managers,
        ));
    }

    public function actionExist(){
        if(!empty($_POST)) {
            $mgr_account = $_POST['mgr_account'];
            //Yii::log($mgr_account, CLogger::LEVEL_ERROR);
            if ($mgr_account == null) {
                //throw new CHttpException(500, 'Internal Error!');
                echo null;
            }
            if(ManagerModel::isExist($mgr_account)){
                echo CJSON::encode('true');
            }else{
                echo CJSON::encode('false');
            }
        }else{
            echo CJSON::encode('false');
        }
    }

    //新添管理员
    public function actionInsert(){
        $managers = null;
        if(!empty($_POST)){
            $manager = new ManagerModel();
            $manager->mgr_account = $_POST['mgr']['mgr_account'];
            $password = $_POST['mgr']['password'];
            $manager->password = md5($password);
            $manager->mstatus = $_POST['mgr']['mstatus'];

            if(($manager->save())) {
                echo CJSON::encode(array($manager));
            }else{
                throw new CHttpException(503,$manager->getErrors());
            }
        }else{
            throw new CHttpException(403, 'Access Forbidden!');
        }
    }

    public function actionDelete(){
        $rtn = -1;
        if(!empty($_POST)){
            $mgr_id = $_POST['mgr']['mgr_id'];
            if($mgr_id == null){
                throw new CHttpException(500, 'Internal Error!');
            }
            $rtn = ManagerModel::model()->deleteByPk($mgr_id);
            if($rtn > ReturnCode::RETURN_CODE_DB_ERROR){
                $managers = ManagerModel::model()->findAll();
                echo CJSON::encode($managers);
            }
        }else{
            throw new CHttpException(403, 'Access Forbidden!');
        }
    }

    public function actionCheck(){
        $manager = null;
        if(!empty($_POST)){
            $mgr_id = $_POST['mgr']['mgr_id'];
            if($mgr_id == null){
                //throw new CHttpException(500, 'Internal Error!');
                echo null;
            }
            $manager = ManagerModel::model()->findByPk($mgr_id);
            echo CJSON::encode($manager);
        }else{
            throw new CHttpException(403, 'Access Forbidden!');
        }
    }

    public function actionUpdate(){
        if(!empty($_POST)){
            $mgr_id = $_POST['mgr']['mgr_id'];
            $mstatus = $_POST['mgr']['mstatus'];
            if($mgr_id == null){
                //throw new CHttpException(500, 'Internal Error!');
                echo null;
            }
            $manager = ManagerModel::model()->findByPk($mgr_id);
            if($manager != null){
                //ManagerModel::model()->updateByPk($mgr_id, array('mstatus=:mstatus'), null, array(':mstatus'=>$mstatus));
                $manager->mstatus = $mstatus;
                if(!$manager->save()) {
                    throw new CHttpException(503,$manager->getErrors());
                }
                $managers = ManagerModel::model()->findAll();
                echo CJSON::encode($managers);
            }else{
                echo null;
            }
        }else{
            throw new CHttpException(403, 'Access Forbidden!');
        }
    }

    public function actionTest(){
        //$managers = ManagerModel::model()->findAll();
        //echo CJSON::encode($managers);
        $manager = ManagerModel::model()->findByPk('43');
        echo CJSON::encode($manager);
    }
}