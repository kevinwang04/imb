<?php
/**
 * Created by PhpStorm.
 * User: ljm
 * Date: 2015/4/8
 * Time: 21:42
 */
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
    'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
    <?php echo CHtml::encode($message); ?>
</div>