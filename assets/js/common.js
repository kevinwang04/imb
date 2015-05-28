/**
 * Created by ljm on 2015/4/11.
 */
var RETURN_DATA_TYPE_JSON = 'json'; //.post()与.ajax()请求方法返回的数据格式

function setDivHide(divId){
    $(divId).css("display", "none");
}

function setDivShow(divId){
    $(divId).css("display", "block");
}

function removeErrorCss(modalId){
    $('div[class="errorMessage"]').remove(); //删除错误提示div
    $(modalId + ' label').css("color","#000000");
    $(modalId + ' input').css("border-color","#cccccc");
}