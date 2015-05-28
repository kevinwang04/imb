<?php Yii::app()->clientScript->registerScriptFile("/imb/assets/js/manager.js");?>

<h2>管理员列表</h2>
<button class="btn btn-small btn-success item-add" onclick="showInsertMgrModal();" type="button">添加</button>
<table class="table table-bordered">
    <thead>
        <tr class="item-thread-tr">
            <th>管理员ID</th>
            <th>用户名</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody id="manager_tbody">
        <?php
            $html = '';
            $operations = '';
            $mstatus_name = '未知';
            foreach($managers as $manager){
                $mgr_id = $manager->mgr_id;
                $mgr_id_str = '"'.$mgr_id.'"';
                $operations = '';
                if($manager->mstatus == ManagerModel::MGR_STATUS_ENABLE){
                    $mstatus_name = '启用';
                }elseif($manager->mstatus == ManagerModel::MGR_STATUS_DISABLE){
                    $mstatus_name = '禁用';
                }else{
                    $mstatus_name = '未知';
                }

                $operations .= "<button class='btn btn-info' id='btnMgrCheck' onclick='showCheckMgrModal($mgr_id_str)'>查看</button>"."    ";
                $operations .= "<button class='btn btn-primary' id='btnMgrEdit' onclick='showEditMgrModal($mgr_id_str)'>编辑</button>"."    ";
                $operations .= "<button class='btn btn-danger' id='btnMgrDel' onclick='showDeleteMgrModal($mgr_id_str)'>删除</a>";

                $html .= "<tr>";
                $html .= '<td>'.$mgr_id.'</td>';
                $html .= '<td>'.$manager->mgr_account.'</td>';
                $html .= '<td>'.$mstatus_name.'</td>';
                $html .= '<td>'.$operations.'</td>';
                $html .= '</tr>';
            }
            echo $html;
        ?>
    </tbody>
</table>

<!--<form action="/imb/index.php/manager/insert" method="post">-->
    <div id="managerModal" class="modal hide fade modal-custom" tabindex="-1" role="dialog" aria-labelledby="managerModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="managerModalLabel">管理员</h3>
        </div>
        <div class="modal-body">
            <?php $this->renderPartial('_form'); ?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <button class="btn btn-primary" id='btnManagerAdd' onclick="insertManager()">保存</button>
            <button class="btn btn-primary" id='btnManagerUpdate'">修改</button>
        </div>
    </div>
<!--</form>-->
<?php $this->renderPartial('//layouts/del_modal'); ?>
