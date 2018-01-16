<?php
use yii\helpers\Html;

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>test</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<style type="text/css">
*{list-style:none;font-size:14px;font-family:tahoma;}
</style>
</head>
<body>

<pre>

①　render显示view和layout
②　renderPartial只显示view

</pre>
<hr />

<?php

echo $name, '<br />';
echo $msg,'<br />';


?>

<h2><?= Html::encode($msg) ?></h2>


<script type="text/javascript">



</script>
</body>
</html>

