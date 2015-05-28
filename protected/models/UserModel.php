<?php
/**
 * Created by PhpStorm.
 * User: ljm
 * Date: 2015/4/8
 * Time: 22:27
 */

class UserModel extends CActiveRecord{
    public $user_id;
    public $uuid;
    public $login_time;
    public $user_info;
    public $ustatus;

    const USER_STATUS_DISABLE  = 0;    //用户状态：禁用
    const USER_STATUS_ENABLE   = 1;    //用户状态：启用

    public function tableName(){
        return 'mb_user';
    }

    public function rules(){
        return array(
            array('uuid, login_time, ustatus', 'required'),
            array('user_info', 'length', 'max'=>128),
            array('ustatus', 'length', 'max'=>128),
        );
    }

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function  attributeLabels(){
        return array(
            'user_id'=>'用户ID',
            'uuid'=>'设备ID',
            'login_time'=>'登陆时间',
            'user_info'=>'用户信息',
            'ustatus'=>'用户状态',
        );
    }
}