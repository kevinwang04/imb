<!--<form id="manager_general_form" action="" method="post">-->
    <div class="form" id="div_mgr_form">
        <div class="control-group">
            <label class="control-label" id="label_mgr_account">用户名</label>
            <div class="controls" id="div_mgr_account">
                <input name="mgr_account" id="mgr_account" type="text"/>
            </div>
        </div>

        <div id="div_mgr_passwords" style="display: none;">
            <div class="control-group">
                <label class="control-label" id="label_password">密码</label>
                <div class="controls" id="div_password">
                    <input name="password" id="password" type="password"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"  id="label_password_again">请再次输入密码</label>
                <div class="controls"  id="div_password_again">
                    <input name="password_again" id="password_again" type="password"/>
                </div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">状态</label>
            <div class="controls">
                <select name="mstatus">
                    <option value="1">启用</option>
                    <option value="0">禁用</option>
                </select>
            </div>
        </div>
    </div>
<!--</form>-->