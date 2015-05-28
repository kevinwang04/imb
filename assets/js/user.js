/**
 * Created by ljm on 2015/4/15.
 */
var urlCommon = '/imb/index.php/user';
var USER_STATUS_DISABLE  = 0;    //用户状态：禁用
var USER_STATUS_ENABLE   = 1;    //用户状态：启用

function showDeleteUserModal(user_id){
    $('#delModal').modal('show');
    $('#btnDelConfirm').off().on('click', function(){
        deleteUser(user_id);
    });
}

function deleteUser(user_id){
    var uri = '/delete';
    var data = {
        'user': {
            'user_id' : user_id
        }
    };
    $.ajax({
        type : 'POST',
        url: urlCommon + uri,
        data: data,
        success: function (rdata) {
            flushUserTable(rdata);
        },
        error: function (rdata) {
            alert(JSON.stringify(rdata));                                   //**********************Test*******************//
        },
        dataType: RETURN_DATA_TYPE_JSON
    });

    $('#delModal').modal('hide');
}

function flushUserTable(userArr){
    var tbody = $('#user_tbody');
    tbody.html("");
    var operations = "";
    var html = "";
    var ustatus_name = "未知";
    var user_id_str = "";

    var arrLength = userArr.length;
    var user = {};
    var login_time = '';
    var date_tmp = null;
    for (var i = 0; i < arrLength; i++) {
        user = userArr[i];
        operations = "";

        date_tmp = new Date(user.login_time*1000);
        Y = date_tmp.getFullYear() + '-';
        M = ((date_tmp.getMonth()+1 < 10) ? '0'+(date_tmp.getMonth()+1) : (date_tmp.getMonth()+1)) + '-';
        D = date_tmp.getDate() +' ';
        h = ((date_tmp.getHours() < 10) ? '0'+date_tmp.getHours() : date_tmp.getHours())  +':';
        m = date_tmp.getMinutes() +':';
        s = date_tmp.getSeconds();

        user_id_str = '"' + user.user_id + '"';
        if (user.ustatus == USER_STATUS_ENABLE) {
            ustatus_name = '启用';
        } else if (user.ustatus == USER_STATUS_DISABLE) {
            ustatus_name = '禁用';
        }else{
            ustatus_name = "未知";
        }
        
        operations += "<button class='btn btn-danger' id='btnUserDel' onclick='showDeleteUserModal("+ user_id_str + ")'>删除</button>";
        html += "<tr>";
        html += '<td style="width: 20%">' + user.uuid + '</td>';
        html += '<td style="width: 20%">' + (Y+M+D+h+m+s) + '</td>';
        html += '<td style="width: 30%">' + user.user_info + '</td>';
        html += '<td style="width: 15%">' + ustatus_name + '</td>';
        html += '<td style="width: 15%">' + operations + '</td>';
        html += "</tr>";
    }
    tbody.append(html);
}