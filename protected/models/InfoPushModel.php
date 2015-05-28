<?php
/**
 * Created by PhpStorm.
 * User: ljm
 * Date: 2015/4/8
 * Time: 22:28
 */

class InfoPushModel extends CActiveRecord{
    public $id;
    public $dev_type;
    public $content;

    public function tableName(){
        return 'mb_info_push';
    }

    public function  rules(){
        return array(
            array('content', 'required'),
        );
    }

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function attributeLabels(){
        return array(
            'id'=>'消息ID',
            'dev_type'=>'设备类型',
            'content'=>'消息内容',
        );
    }
}