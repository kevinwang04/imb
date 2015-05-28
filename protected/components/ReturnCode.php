<?php
/**
 * Created by PhpStorm.
 * User: ljm
 * Date: 2015/4/11
 * Time: 17:47
 */

class ReturnCode {
    const RETURN_CODE_SUCCESS                   = '000000';    //操作成功

    const RETURN_CODE_PARAMETER_EMPTY           = '100001';    //必填的参数为空
    const RETURN_CODE_PARAMETER_FORMAT_ERROR    = '100002';    //参数格式错误

    const RETURN_CODE_DB_EXCEPTION              = '200001';    //数据库操作异常

    const RETURN_CODE_USER_NOT_FOUND            = '000000';    //用户不存在
    const RETURN_CODE_USER_STATUS_DISABLE       = '000000';    //用户状态不可用
    const RETURN_CODE_USER_PASSWWD_ERROR        = '000000';    //用户密码错误

    const RETURN_CODE_DB_ERROR = -1;    //数据库操作错误
}