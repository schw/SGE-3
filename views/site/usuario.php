<?php
use yii\helpers\Html;

if(isset($model)){
	$this->title = $model->nome;
	//$this->params['breadcrumbs'][] = ['label' => 'Pagina do '.$model->nome, 'url'=> ['usuario']];
	$this->params['breadcrumbs'][] = $this->title;
}
?>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/sge.css" >
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
	<body> 
		<div class="conteudo">
			<div class="menuLateral" >
				 <?=  Html::tag('div', 'Ola Usuario, Bem Vindo! Seu perfil atual e Participante.
					Para sair do Sistema faca Logout', ['class'=>'cabecalho']);?>
				<div class="opcao"><?= Html::a('Pagina inicial', ['/site/usuario'],['class'=>'sge texto']) ?></div>	
				<div class="opcao"><?= Html::a('Eventos', ['/site/usuario'], ['class'=>'sge texto']) ?></div>	
				<div class="opcao"><?= Html::a('Participando', ['/site/usuario'], ['class'=>'sge texto']) ?></div>
				<div class="opcao"><?= Html::a('Ativos', ['/site/usuario'], ['class'=>'sge texto']) ?></div>
				<div class="opcao"><?= Html::a('Passados', ['/site/usuario'], ['class'=>'sge texto']) ?></div>
			</div>
			
			<div class="corpo"><?php ?></div>
		</div>	
	</body>
</html>
