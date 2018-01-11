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
render渲染、renderPartial渲染部分、renderContent、renderAjax、renderFile

①　render显示view和layout
②　renderPartial只显示view
③　renderContent只渲染layout
④　renderFile显示指定的文件，是最基础的方法，
renderAjax,renderPartial最终都是调用renderFile.
⑤　renderAjax只显示view，以ajax方式渲染页面，可以配合js/css实现各种特效
</pre>
<hr />

<?php

echo $name, '<br />';
echo $msg,'<br />';


?>



<script type="text/javascript">



</script>
</body>
</html>

