<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <?php
        Yii::app()->bootstrap->register();
        Yii::app()->clientScript->registerCssFile("/imb/css/menu/styles.css");
        Yii::app()->clientScript->registerCssFile("/imb/css/content/styles.css");
        Yii::app()->clientScript->registerScriptFile("/imb/assets/js/common.js");
        Yii::app()->clientScript->registerScriptFile("/imb/assets/js/verification.js");
    ?>
</head>

<body>
<div class="navbar navbar-inverse  navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container" style="margin-left: 40px;">
            <a class="brand" href="/imb/index.php">iMB</a>
            <ul class="nav pull-right">
                <!--<li><a href="#">关于</a></li>
                <li><a href="#">联系</a></li>-->
            </ul>
        </div>
    </div>
</div>

<div id="page">
    <div class="container-fluid">
        <div class="span12" style="margin-left: 0px">
            <div class="row">
                <div class="span2">
                    <!--Sidebar content-->
                    <?php $this->renderPartial('//layouts/menu') ;?>
                </div>
                <!--Main content-->
                <div class="span10">
                    <div class="page-content">
                        <div>
                            <?php echo $content;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
