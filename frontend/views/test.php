<?php
use yii\helpers\Html;

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>tvest</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<style type="text/css">
*{list-style:none;font-size:14px;font-family:tahoma;}
</style>
</head>
<body>

<pre>

render显示view和layoutS
renderPartial只显示view

</pre>


<hr />

<h3>
    <?php
    echo __FILE__,'<br />';
    ?>
</h3>

<?php

echo  $this->context->module->id,'<br />';     //视图在中获取模块名
echo  $this->context->id,'<br />' ;        //控制器名
echo  $this->context->action->id,'<br />' ;    // 方法名
echo '<br />';

echo $name, '<br />';
echo $msg,'<br />';


?>

<h2><?= Html::encode($msg) ?></h2>


<script type="text/javascript">



</script>
</body>
</html>

