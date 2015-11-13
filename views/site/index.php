<?php


if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario != 3)
    Yii::$app->getResponse()->redirect(array('evento/gerenciareventos'));
else
	Yii::$app->getResponse()->redirect(array('evento/', 'status' => 'ativo'));

?>