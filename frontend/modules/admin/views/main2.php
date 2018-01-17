<?php

use yii\helpers\Html;

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>

</head>
<body>


<div class="admin-default-index">
    <p><?= $this->context->action->uniqueId ?></p>
    <p><?= $this->context->action->id ?></p>
    <p>
        The action belongs to the controller "<b><?= get_class($this->context) ?></b>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <h3><?= __FILE__ ?></h3>
</div>

<hr>


<div class="container">
    <?= $content ?>
</div>

<?php $this->beginBody() ?>
<?php $this->endBody() ?>


</body>
</html>



