<?php
/**
 * Created by PhpStorm.
 * User: ljm
 * Date: 2015/4/8
 * Time: 22:25
 */

class ManagerModel extends CActiveRecord{
    public $mgr_id;          //管理员ID
    public $mgr_account;     //管理员账号
    public $password;        //管理员密码
    public $mstatus;         //管理员状态 0：禁用; 1：启用

    const MGR_STATUS_DISABLE  = 0;    //用户状态：禁用
    const MGR_STATUS_ENABLE   = 1;    //用户状态：启用

    public function tableName(){
        return 'mb_manager';
    }

    public function rules(){
        return array(
            array('mgr_account, password', 'required'),
            array('mgr_account', 'length', 'max'=>32),
        );
    }

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function attributeLabels(){
        return array(
            'mgr_id' => '用户ID',
            'mgr_account' => '用户名',
            'password'=>'密码',
            'mstatus' => '状态',
        );
    }

    public static function isExist($mgr_account){
        $manager = Yii::app()->db->createCommand()->select('mgr_id,mgr_account')->from('mb_manager')->where('mgr_account=:account', array(':account'=>$mgr_account))->queryRow();
        if(!empty($manager))
            return true;
        else
            return false;
    }
}