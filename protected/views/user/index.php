<?php Yii::app()->clientScript->registerScriptFile("/imb/assets/js/user.js");?>
<script type="javascript" onload="">

</script>

<h2>用户列表</h2>
<table class="table table-bordered">
    <thead>
    <tr class="item-thread-tr">
        <th>用户UUID</th>
        <th>登陆时间</th>
        <th>用户信息</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody id="user_tbody">
    <?php
        $html = '';
        $operations = '';
        $ustatus_name = '未知';
        foreach($users as $user){
            $user_id = $user->user_id;
            $user_id_str = '"'.$user_id.'"';
            $operations = '';
            if($user->ustatus == UserModel::USER_STATUS_ENABLE){
                $ustatus_name = '启用';
            }elseif($user->ustatus == UserModel::USER_STATUS_DISABLE){
                $ustatus_name = '禁用';
            }else{
                $ustatus_name = '未知';
            }

            //$operations .= "<button class='btn btn-info' id='btnUserCheck' onclick='showCheckUserModal($user_id_str)'>查看</button>"."    ";
            //$operations .= "<button class='btn btn-primary' id='btnUserEdit' onclick='showEditUserModal($user_id_str)'>编辑</button>"."    ";
            $operations .= "<button class='btn btn-danger' id='btnUserDel' onclick='showDeleteUserModal($user_id_str)'>删除</a>";

            $html .= "<tr>";
            $html .= '<td style="width: 20%">'.$user->uuid.'</td>';
            $html .= '<td style="width: 20%">'.date("Y-m-d H:i:s", $user->login_time).'</td>';
            $html .= '<td style="width: 30%">'.$user->user_info.'</td>';
            $html .= '<td style="width: 15%">'.$ustatus_name.'</td>';
            $html .= '<td style="width: 15%">'.$operations.'</td>';
            $html .= '</tr>';
        }
        echo $html;
    ?>
    </tbody>
</table>

<?php $this->renderPartial('//layouts/del_modal'); ?>