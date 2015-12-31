<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */

?>


<div class="evento-identidade">

	<!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">

	   <h2> Selecione uma imagem para o certificado </h2>

	    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','target' => '_blank']]); ?>
	    
	    <?= $form->field($model, 'imagem')->fileInput() ?>
		<p>
	    	Obs.: A não seleção de uma imagem acarretará que 
	    		os certificados serão gerados em um formato padrão.
	    </p>
	    
	    <div class="form-group">

			<?= Html::submitButton('Visualizar Certificado', ['class' => 'btn btn-warning', 'name' => 'frag2']); ?>
			<?= Html::submitButton('Salvar', ['name' => 'frag','class' => 'btn btn-success']); ?>
			<?= Html::SubmitButton('Salvar e Visualizar Certificado', ['class' => 'btn btn-primary']); ?>
	    </div>
		
		<?php ActiveForm::end(); ?>

</div>






















<div class="evento-form">

	<!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>








