<!-- 右侧菜单栏 -->
<div class="sidebar-menu">
    <a href="#managerMenu" class="nav-header menu-first collapsed item-top" data-toggle="collapse">
        <i class="icon-th-large icon-large"></i>管理员
    </a>
    <ul id="managerMenu" class="nav nav-list collapse menu-second">
        <li><a href="<?php echo $this->createUrl('/manager/index');?>"><i class="icon-list-alt"></i>管理员列表</a></li>
    </ul>

    <a href="#userMenu" class="nav-header menu-first collapsed" data-toggle="collapse">
        <i class="icon-user icon-large"></i>用户
    </a>
    <ul id="userMenu" class="nav nav-list collapse menu-second">
        <li><a href="<?php echo $this->createUrl('/user/index');?>"><i class="icon-list-alt"></i>用户列表</a></li>
        <li><a href="#"><i class="icon-align-justify"></i>用户账单</a></li>
    </ul>

    <a href="#infoMenu" class="nav-header menu-first collapsed item-bottom" data-toggle="collapse">
        <i class="icon-info-sign icon-large"></i>消息
    </a>
    <ul id="infoMenu" class="nav nav-list collapse menu-second">
        <li><a href="#" ><i class="icon-list-alt"></i>消息列表</a></li>
        <li><a href="#" class="item-bottom"><i class="icon-edit"></i>添加消息</a></li>
    </ul>
</div>

