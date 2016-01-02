</body>
<?php
use kartik\social\FacebookPlugin;
use kartik\social\GooglePlugin;
use kartik\social\TwitterPlugin;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
	<meta charset="UTF-8"/>
	<meta property="og:url"           content=<?php echo Yii::$app->request->absoluteUrl;?> />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="<?php echo $model->descricao;?>" />
	<meta property="og:description"   content="Evento do Instituto de Computação da UFAM"/>
	<meta property="og:image"		  content="<?php echo "https://".Yii::$app->request->serverName.Yii::$app->request->baseUrl."/img/home_icomp.png"; ?>">
</head>
<body>
<div class="evento-view">
    <?= Yii::$app->view->renderFile('@app/views/layouts/menulateral.php') ?>

   <div id="page-wrapper">
    <div id="geral" style="width: 100%; text-align: center;">
        <div id="titulo" style= "float: left">
            <label><strong><h1><?= Html::encode($this->title) ?></h1></strong></label>
        </div>

    <div style="width: 80px; float: right; padding: 10px;">
            <?php echo Html::a(Html::img('@web/img/pacotes.png'), ['pacote/index','idevento' => $model->idevento], ['width' => '10']) ?>
            <?php echo Html::a('Pacote', ['pacote/index', 'idevento' => $model->idevento]); ?>
        </div>
        <div style="width: 100px; float: right; padding: 10px;">
            <?php echo Html::a(Html::img('@web/img/programacao.png'), ['item-programacao/index','idevento' => $model->idevento], ['width' => '10']) ?>
            <?php echo Html::a('Programação', ['item-programacao/index', 'idevento' => $model->idevento]); ?>
        </div>
        
        <?php if( (!Yii::$app->user->isGuest)  && Yii::$app->user->identity->idusuario == $model->responsavel) { ?>
        <!-- Certificado -->

<!-- Modal -->
<div class="modal fade" id="modalEventoPdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Escolha o Tipo de Usuário </h4>
      </div>
      <div class="modal-body">

                        <?php echo Html::a('Participante', ['/certificados/credenciado'], [
                        'class' => 'btn btn-primary',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $model->idevento],
                    ]
                    ]); ?>
                        <?php echo Html::a('Palestrante', ['/certificados/palestrante'], 
                        [
                        'class' => 'btn btn-primary',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $model->idevento],
                    ]
                    ]); ?>  
                        <?php echo Html::a('Voluntário', ['/certificados/voluntario'], [
                        'class' => 'btn btn-primary',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $model->idevento],
                    ]
                    ]); ?>  
            
      </div>

    </div>
  </div>
</div>
<!-- -->

                    <div style=" float: right; padding: 10px;">
                    <a data-toggle="modal" data-target="#modalEventoPdf">
                        <div style="width: 50px; float: left">
                            <img src = '../web/img/certificado.png'><br>
                                   Gerar Certificado
                        </div>    
                    </a>

                    </div>
                    <!-- fim do certificado -->
        <?php } ?>


        <?php if(!Yii::$app->user->isGuest && $model->canAccess()){ ?>
            <div style="width: 80px; float: right; padding: 10px;">
                <?= Html::a(Html::img('@web/img/delete.png'), ['delete', 'id' => $model->idevento], [
                    'data' => [
                        'confirm' => 'Deseja remover o evento "'.$model->descricao.'" ?',
                        'method' => 'post',
                    ],
                ]) ?>
                        <?= Html::a('Remover Evento', ['delete', 'id' => $model->idevento], [
                            'data' => [
                                'confirm' => 'Deseja remover o evento "'.$model->descricao.'" ?',
                                'method' => 'post',
                            ],
                        ]) ?>
            </div>
            <div style="width: 80px; float: right; padding: 10px;">
                <?= Html::a(Html::img('@web/img/editar.png'), ['update', 'id' => $model->idevento]) ?>
                <?php echo Html::a('Alterar Evento', 'index.php?r=evento/update&id='.$model->idevento); ?>
            </div>
            <div style="width: 80px; float: right; padding: 10px;">
                <?php echo Html::a(Html::img('@web/img/listar_inscritos.png'), ['inscritos/index','evento_idevento' => $model->idevento], ['width' => '10']) ?>
                <?php echo Html::a('Listar Inscritos', 'index.php?r=inscritos/index&evento_idevento='.$model->idevento); ?>
            </div>

                                
            
            <?php if(!Yii::$app->user->isGuest && $model->canAccessResponsible()){ ?>
                <div style="width: 100px; float: right; padding: 10px;">
                    <?php echo Html::a(Html::img('@web/img/add.png'), ['coordenador-has-evento/index','idevento' => $model->idevento], ['width' => '10']) ?>
                    <?php echo Html::a('Adicionar Coordenadores', ['coordenador-has-evento/index', 'idevento' => $model->idevento]); ?>
                </div>
                <?php } ?>
            <div style="width: 100px; float: right; padding: 10px;">
                <?php echo Html::a(Html::img('@web/img/add.png'), ['evento-has-voluntario/index','idevento' => $model->idevento], ['width' => '10']) ?>
                <?php echo Html::a('Adicionar Voluntários', ['evento-has-voluntario/index', 'idevento' => $model->idevento]); ?>
            </div>
        <?php 
        }?>

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario == 3){
 
        if(!$encerrado){     
            if(!$inscrito){ 
                if($existeVagas != 0){ ?>

                        <div style="width: 80px; float: right; padding: 10px;">
                            <?php echo Html::a(Html::img('@web/img/ok.png'), ['inscreve/inscrever'],  [
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['evento_idevento' => $model->idevento],
                        ]
                        ]); ?>
                            <?php echo Html::a('Realizar Inscrição', ['inscreve/inscrever'], [
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['evento_idevento' => $model->idevento],
                        ]
                        ]);?>
                        </div>

                    <?php 
                }
                else{ ?>
                        <div style="width: 80px; float: right; padding: 10px;">
                            <?php echo Html::a(Html::img('@web/img/notok.png'), ['inscreve/'],  [
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['evento_idevento' => $model->idevento],
                        ]
                        ]); ?>
                            <?php echo Html::a('Vagas Esgotadas', ['inscreve/'], [
                            'data'=>[
                            'method' => 'POST',
                            'params'=>['evento_idevento' => $model->idevento],
                        ]
                        ]);?>
                        </div>



                <?php } 
            }else{ ?>

                            <div style="width: 80px; float: right; padding: 10px;">
                                <?= Html::a(Html::img('@web/img/block.png'), ['inscreve/cancelar'], [
                                    'data' => [
                                    'confirm' => 'Deseja cancelar inscrição no evento "'.$model->descricao.'" ?',
                                        'method' => 'POST',
                                        'params'=>['evento_idevento' => $model->idevento],
                                    ],
                                ]) ?>
                                <?php echo Html::a('Cancelar Inscrição', ['inscreve/cancelar'], [
                                    'data'=>[
                                    'confirm' => 'Deseja cancelar inscrição no evento "'.$model->descricao.'" ?',
                                    'method' => 'POST',
                                    'params'=>['evento_idevento' => $model->idevento],
                                ]
                                ]); ?>
                            </div>

                    <?php 
                }
        }
        else if ((!Yii::$app->user->isGuest) && $credenciamento){ ?>
                                <!-- Certificado -->
                    <div style="width: 80px; float: right; padding: 10px;">
                        <?php echo Html::a(Html::img('@web/img/certificado.png'), ['inscreve/pdf'], ['target' => 'blank',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $model->idevento],
                    ]
                    ]); ?>
                        <?php echo Html::a('Imprimir Certificado', ['inscreve/pdf'], ['target' => 'blank',
                        'data'=>[
                        'method' => 'POST',
                        'params'=>['evento_idevento' => $model->idevento],
                    ]
                    ]);?>
                    </div>
                    <!-- fim do certificado -->
        <?php }
    } ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sigla',
            'descricao',
            'dataini',
            'datafim',
            'horaIni',
            'horaFim',
            'vagas',
            'CargaHoraria',
            'detalhe',
            'tipo.titulo',
            'local.descricao',
        ],
    ]) ?>
	<div style="height: 30px; width: 100%; display: inline-block;">
	   <div style="float: left">
	   <?php echo FacebookPlugin::widget(
			['type'=>FacebookPlugin::SHARE, 
			 'settings' => ['layout' => 'button_count','href'=>Yii::$app->request->absoluteUrl]	
			]);?>
		</div>
		<div style="margin: 1px 0 0 5px; float: left;" >
		<?php echo GooglePlugin::widget(
			['type'=>GooglePlugin::SHARE,
			 'settings' => ['annotation'=>'bubble','height'=>20]
			]);
		?>
		<?php echo TwitterPlugin::widget(
				['type'=>TwitterPlugin::SHARE, 
				 'settings' => ['size'=>'medium']			
		]);
		?></div>
	</div>
    <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2)){ ?>
    <h2>QRCode <?= $model->descricao ?></h2>
    <?= Html::img('plugins/getQRCode.php?conteudo_QRCODE='.$model->idevento, ['alt' => 'QRCode', 'id' => 'imgqrcode']) ?>
    <?php } ?>
</div>
</div>

