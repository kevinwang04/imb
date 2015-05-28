/**
 * Created by ljm on 2015/4/9.
 */
var urlCommon = '/imb/index.php/manager';
var MGR_STATUS_DISABLE  = 0;    //用户状态：禁用
var MGR_STATUS_ENABLE   = 1;    //用户状态：启用

var FLUSH_TABLE_TYPE_INSERT = 0;    //插入情况下刷新表格
var FLUSH_TABLE_TYPE_UPDATE = 1;    //更新情况下刷新表格
var FLUSH_TABLE_TYPE_DELETE = 2;    //删除情况下刷新表格

var mgrModalId = '#managerModal';

function showInsertMgrModal(){
    initInsertMgrModal();
    $(mgrModalId).modal('show');
}

function showEditMgrModal(mgr_id){
    initEditMgrModal();

    var uri = '/check';
    var data = {
        'mgr': {
            'mgr_id' : mgr_id
        }
    };
    $.post(urlCommon+uri, data, function(rdata){
        setMgrModal(rdata);
        $(mgrModalId).modal('show');

        $('#btnManagerUpdate').off().on('click', function(){
            updateManager(mgr_id);
        });
    }, RETURN_DATA_TYPE_JSON);  //若没有指定返回数据类型，会被自动识别为字符串格式!!!
}

function showCheckMgrModal(mgr_id){
    initCheckMgrModal();

    var uri = '/check';
    var data = {
        'mgr': {
            'mgr_id' : mgr_id
        }
    };
    $.post(urlCommon+uri, data, function(rdata){
        setMgrModal(rdata);
        $(mgrModalId).modal('show');
    }, RETURN_DATA_TYPE_JSON);  //若没有指定返回数据类型，会被自动识别为字符串格式!!!
}

function showDeleteMgrModal(mgr_id){
    $('#delModal').modal('show');
    $('#btnDelConfirm').off().on('click', function(){
        deleteManager(mgr_id);
    });
}

function insertManager(){
    var uriInsert = '/insert';
    var uriExist = '/exist';
    var mgr_account = $('#mgr_account').val();
    var password = $('#password').val();
    var mstatus = $("select[name='mstatus'] option:selected").val();

    //格式验证
    var correct = true;
    if(isNull('mgr_account','用户名')){
        correct = false;
    }else{
        var dtmp = {
            'mgr_account' : mgr_account
        };
        $.ajax({
            type: 'POST',
            url: urlCommon + uriExist,
            data: dtmp,//"{'mgr_account':'" + mgr_account +"'}",
            success: function (rdata) {
                if(rdata == "true"){
                    customError('mgr_account', '用户名已存在', true);
                }else{
                    customError('mgr_account', null, false);
                }
            },
            error: function (rdata) {
                alert(JSON.stringify(rdata));                                   //**********************Test*******************//
            },
            dataType: RETURN_DATA_TYPE_JSON
        });
    }

    if(isNull('password','密码')){
        correct = false;
    }
    if(isNull('password_again','密码')){
        correct = false;
    }
    if(correct && isDifferent('password', 'password_again', '密码')){
        correct = false;
    }

    if(!correct)
        return;

    var data = {
        'mgr': {
            'mgr_account' : mgr_account,
            'password' : password,
            'mstatus' : mstatus
        }
    };

    $.ajax({
        type: 'POST',
        url: urlCommon + uriInsert,
        data: data,
        success: function (rdata) {
            flushManagerTable(rdata, FLUSH_TABLE_TYPE_INSERT);
        },
        error: function (rdata) {
            alert(JSON.stringify(rdata));                                   //**********************Test*******************//
        },
        dataType: RETURN_DATA_TYPE_JSON
    });

    $(mgrModalId).modal('hide');
}

//待修改
function updateManager(mgr_id){
    var uri = '/update';
    var mgr_account = $('#mgr_account').val();
    //var password = $('#password').val();
    var mstatus = $("select[name='mstatus'] option:selected").val();
    var data = {
        'mgr': {
            'mgr_id' : mgr_id,
            'mstatus' : mstatus
        }
    };

    $.ajax({
        type: 'POST',
        url: urlCommon + uri,
        data: data,
        success: function (rdata) {
            flushManagerTable(rdata, FLUSH_TABLE_TYPE_UPDATE);
        },
        error: function (rdata) {
            alert(JSON.stringify(rdata));                                   //**********************Test*******************//
        },
        dataType: RETURN_DATA_TYPE_JSON
    });

    $(mgrModalId).modal('hide');
}

function deleteManager(mgr_id){
    var uri = '/delete';
    var data = {
        'mgr': {
            'mgr_id' : mgr_id
        }
    };
    $.ajax({
        type : 'POST',
        url: urlCommon + uri,
        data: data,
        success: function (rdata) {
            flushManagerTable(rdata, FLUSH_TABLE_TYPE_DELETE);
        },
        error: function (rdata) {
            alert(JSON.stringify(rdata));                                   //**********************Test*******************//
        },
        dataType: RETURN_DATA_TYPE_JSON
    });

    $('#delModal').modal('hide');
}

//更新管理员表格内容
function flushManagerTable(mgrArr, type){
    var tbody = $('#manager_tbody');
    if(type != FLUSH_TABLE_TYPE_INSERT){
        tbody.html("");
    }

    var operations = "";
    var html = "";
    var mstatus_name = "未知";
    var mgr_id_str = "";

    var arrLength = mgrArr.length;
    var mgr = {};
    for (var i = 0; i < arrLength; i++) {
        operations = "";
        mgr = mgrArr[i];
        mgr_id_str = '"' + mgr.mgr_id + '"';
        if (mgr.mstatus == MGR_STATUS_ENABLE) {
            mstatus_name = '启用';
        } else if (mgr.mstatus == MGR_STATUS_DISABLE) {
            mstatus_name = '禁用';
        }else{
            mstatus_name = "未知";
        }

        operations += "<button class='btn btn-info' id='btnMgrCheck' onclick='showCheckMgrModal(" + mgr_id_str + ")'>查看</button>" + "    ";
        operations += "<button class='btn btn-primary' id='btnMgrEdit' onclick='showEditMgrModal("+ mgr_id_str + ")'>编辑</button>" + "    ";
        operations += "<button class='btn btn-danger' id='btnMgrDel' onclick='showDeleteMgrModal("+ mgr_id_str + ")'>删除</button>";
        html += "<tr>";
        html += '<td>' + mgr.mgr_id + '</td>';
        html += '<td>' + mgr.mgr_account + '</td>';
        html += '<td>' + mstatus_name + '</td>';
        html += '<td>' + operations + '</td>';
        html += "</tr>";
    }
    tbody.append(html);
}

function initInsertMgrModal(){
    removeErrorCss(mgrModalId);
    var accountDiv = $('#mgr_account');
    var statusSelect = $("select[name='mstatus']");

    accountDiv.val('');
    statusSelect.val(MGR_STATUS_ENABLE);
    $('#password').val('');
    $('#password_again').val('');
    setDivShow('#div_mgr_passwords');
    $('#btnManagerAdd').show();
    $('#btnManagerUpdate').hide();
    accountDiv.removeAttr('disabled');
    statusSelect.removeAttr('disabled');
}

function initEditMgrModal(){
    removeErrorCss(mgrModalId);
    setDivHide('#div_mgr_passwords');
    $('#btnManagerAdd').hide();
    $('#btnManagerUpdate').show();
    $('#mgr_account').attr('disabled','disabled');
    $('select[name=\'mstatus\']').removeAttr('disabled');
}

function initCheckMgrModal(){
    removeErrorCss(mgrModalId);
    setDivHide('#div_mgr_passwords');
    $('#btnManagerAdd').hide();
    $('#btnManagerUpdate').hide();
    $('#mgr_account').attr('disabled','disabled');
    $("select[name='mstatus']").attr('disabled','disabled');
}

function getMgrModalData(){

}

function setMgrModal(manager){
    $('#mgr_account').val(manager.mgr_account);
    $("select[name='mstatus']").val(manager.mstatus);
}

