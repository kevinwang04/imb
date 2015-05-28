/**
 * Created by ljm on 2015/4/14.
 */
/**
 * 自定义错误提示
 * @param inputName 表单名
 * @param prompt    错误提示内容
 * @param choice    是否提示
 * @returns {boolean}
 */
function customError(inputName, prompt, choice){
    var div = $('#div_' + inputName);
    var input = $('input[name="'+ inputName +'"]');
    var label = $('#label_'+inputName);

    if(choice) {
        div.find('div').remove();
        div.append('<div class="errorMessage">请填写' + prompt + '</div>');
        label.css('color', 'red');
        input.css('border-color', 'red');
        input.focus();
        return true;
    }

    label.css('color', '#000000');
    input.css('border-color', '#cccccc');
    return false;
}

/**
 * 检测是否为空
 * @param inputName input表单名
 * @param prompt    错误提示内容
 */
function isNull(inputName, prompt){
    var div = $('#div_' + inputName);
    div.find('div').remove();

    var input = $('input[name="'+ inputName +'"]');
    var label = $('#label_'+inputName);
    if(input.val() == ""){
        div.append('<div class="errorMessage">请填写'+ prompt + '</div>');
        label.css('color', 'red');
        input.css('border-color', 'red');
        input.focus();
        return true;
    }

    label.css('color', '#000000');
    input.css('border-color', '#cccccc');
    return false;
}

/**
 * 检测是否超过最大长度
 * @param inputName input表单名
 * @param prompt    错误提示内容
 */
function isMaxVarcharLength(inputName, prompt){

}

/**
 * 检测两个输入框内容是否一致
 * @param inputName1    input表单名
 * @param inputName2    input表单名
 * @param prompt        错误提示内容
 */
function isDifferent(inputName1, inputName2, prompt){
    var div = $('#div_' + inputName2);
    div.find('div').remove();

    var input1 = $('input[name="'+ inputName1 +'"]');
    var input2 = $('input[name="'+ inputName2 +'"]');
    var label1 = $('#label_'+inputName1);
    var label2 = $('#label_'+inputName2);
    if(input1.val() != input2.val()){
        div.append('<div class="errorMessage">'+ '两次输入的' + prompt + '不一致' +'</div>');
        label1.css('color', 'red');
        input1.css('border-color', 'red');
        label2.css('color', 'red');
        input2.css('border-color', 'red');
        input2.focus();
        return true;
    }

    label1.css('color', '#000000');
    input1.css('border-color', '#cccccc');
    label2.css('color', '#000000');
    input2.css('border-color', '#cccccc');
    return false;
}

/**
 * 检测是否为数字
 * @param inputName input表单名
 * @param prompt    错误提示内容
 */
function isNumber(inputName, prompt){

}