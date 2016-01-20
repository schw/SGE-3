<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;
use yii\helpers\Url;

$this->title = "Imagem Certificado";

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */

?>

<script type="text/javascript">
	
	function retirarBlank(){
		document.getElementById('certificadosform').target = '_self';
	}

</script>


<div class="evento-identidade">

	<!-- Importação do arquivo responsável por receber e exibir mensagens flash -->
    <?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
    
    <!-- Importação do arquivo responsável por exibir o menu lateral-->
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <!-- "page-wrapper" necessário para alinha com o menu lateral. Cobre todo conteudo da view. -->
   <div id="page-wrapper">
        <div id="geral" class="diviconegeral">
            <div id="titulo" style= "float: left;">
                <h1><?= $this->title ?></h1>
            </div>
            <a href=<?= Url::to(['evento/update', 'id' => $model->idevento])?>>
                <div class="divicone divicone-l1">
                    <?= Html::img('@web/img/voltar.png', ['class' => 'imgicone'])?>
                    <p class="labelicone">Voltar</p>
                </div>
            </a>
        </div>



	    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','id' => 'certificadosform','target' => '_blank']]); ?>


	   	<h3> Selecione uma imagem para o certificado </h3>	    
	    <div style="position: relative; border: 3px solid #000000; padding: 10px;"> 
	    	<?= $form->field($model, 'imagem')->fileInput(['accept' => '.jpg, .png, .jpeg']) ?>

	    		    	<b> <div style="color: red;"> Obs.: O não selecionamento de uma imagem acarretará que 
	    		os certificados serão gerados em um formato padrão.
	    					</div>
	    				 </b>

	    </div>



<br>	    
	    		<br>Clicando em <b> Visualizar Certificado </b> é possível observar a prévia de como ficará o certificado.

	    <div class="form-group">
	    <div style = "text-align:center; margin-right:90px"> 
	    	<?= "<br>" ?>
			<?= Html::submitButton('Visualizar Prévia do Certificado', ['class' => 'btn btn-warning', 'name' => 'frag2']); ?>
			<?= Html::submitButton('Finalizar Cadastro do Evento', ['onclick' => 'retirarBlank()' ,'name' => 'frag','class' => 'btn btn-success']); ?>
		</div>

	    </div>


		<p> <br>
<div style="    display: block; margin-top: 0.5em; margin-bottom: 0.5em; margin-left: auto; margin-right: auto; border-style: inset; border-width: 1px;"> </div>
				<b> Recomendações e exemplo para a imagem: </b> <br>

<img src="../web/img/imagem_tutorial_certificado.png" width="700" height="450">
<br><br>
					<b>
					<ul>
						<li> A imagem deve ter extensão: jpg , png , jpeg . </li>  <br> 
						<li> A imagem deve ser composta de Cabeçalho(x), Área de Assinatura e Rodapé (y).</li>  <br>
						<li> O cabeçalho (x) deve ter aproximadamente 30% da altura da imagem.</li> <br>
						<li> A Área de Assinatura juntamente com o Cabeçalho (y) deve ter aproximadamente 25% da altura da imagem.</li> <br>
						<li> A Largura (w) e Altura (z) da imagem deve ter aproximadamente 3450 pixels x 2400 pixels (ou proporcional a isso), respectivamente.</li> <br>
					</ul>
					Para informações mais detalhadas, consulte o manual do usuário. <br>
					</b>
				<br>

	    </p>

	
		<?php ActiveForm::end(); ?>
	</div>


<br><br><br>

</div>
</div>