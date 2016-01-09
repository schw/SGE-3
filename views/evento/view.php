</body>
<?php
use kartik\social\FacebookPlugin;
use kartik\social\GooglePlugin;
use kartik\social\TwitterPlugin;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

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
    <div id="geral" class="diviconegeral">
        <div id="titulo" style= "float: left;">
            <h1>Detalhes</h1>
        </div>
        
        <a href=<?= Url::to(['pacote/index', 'idevento' => $model->idevento])?>>
            <div class="divicone divicone-l1">
                <?= Html::img('@web/img/pacotes.png', ['class' => 'imgicone'])?>
                <p class="labelicone">Pacote</p>
            </div>
        </a>
        
        <a href=<?= Url::to(['item-programacao/index', 'idevento' => $model->idevento])?>>
            <div class="divicone divicone-l2">
                <?= Html::img('@web/img/programacao.png', ['class' => 'imgicone']) ?>
                <p class="labelicone">Programação</p>
            </div>
        </a>
        
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

                    <a data-toggle="modal" data-target="#modalEventoPdf">
                        <div class="divicone divicone-l1">
                            <img src = '../web/img/certificado.png' class="imgicone"><br>
                                   <p>Gerar Certificado</p>
                        </div>
                    </a>
                    <!-- fim do certificado -->
        <?php } ?>


        <?php if(!Yii::$app->user->isGuest && $model->canAccess()){ ?>
                <div class="divicone divicone-l1"> 
                     <?= Html::a(Html::img('@web/img/delete.png', ['class' => 'imgicone']), ['delete', 'id' => $model->idevento], [
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

        <?php if($allow == 0) { ?>
        <a href=<?= Url::to(['evento/update', 'id' => $model->idevento])?>>
            <div class="divicone divicone-l1">
                <?= Html::img('@web/img/editar.png', ['class' => 'imgicone']) ?>
                <p>Alterar Evento</p>
            </div>
        </a>
            
<!-- abrir inscrições -->
        <a href=<?= Url::to(['evento/abrir', 'id' => $model->idevento])?>>
            <div class="divicone divicone-l1">
                <?= Html::img('@web/img/open.png', ['class' => 'imgicone']) ?>
                <?php echo Html::a('Abrir Inscrições', 'index.php?r=evento/abrir&id='.$model->idevento); ?>
            </div>
        </a>


<!-- fim do abrir inscrições -->
<!-- fechar inscrições -->
        <?php 
        }
        else if ($allow == 1) { ?>
            <div class="divicone divicone-l1">
                <?= Html::a(Html::img('@web/img/lock.png'), ['fechar', 'id' => $model->idevento], [
                    'data' => [
                        'confirm' => 'Deseja encerrar as inscrições deste evento?  "'.$model->descricao.'" ?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Encerrar Inscrições', ['fechar', 'id' => $model->idevento], [
                    'data' => [
                        'confirm' => 'Deseja encerrar as inscrições deste evento? "'.$model->descricao.'" ?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        <?php } ?>
<!-- fim do fechar inscrições -->
        <a href=<?= Url::to(['inscritos/index','evento_idevento' => $model->idevento])?>>
            <div class="divicone divicone-l1">
                <?= Html::img('@web/img/listar_inscritos.png', ['class' => 'imgicone']) ?>
                <p>Listar Inscritos</p>
            </div>
        </a>

                                
            
            <?php if(!Yii::$app->user->isGuest && $model->canAccessResponsible()){ ?>
                <a href=<?= Url::to(['coordenador-has-evento/index','idevento' => $model->idevento])?>>
                    <div class="divicone divicone-l2">
                        <?= Html::img('@web/img/addcoord.png', ['class' => 'imgicone']) ?>
                        <p>Adicionar Coordenador</p>
                    </div>
                </a>
            <?php } ?>
            <a href=<?= Url::to( ['evento-has-voluntario/index','idevento' => $model->idevento])?>>
                <div class="divicone divicone-l1">
                    <?= Html::img('@web/img/addvolun.png', ['class' => 'imgicone']) ?>
                    <p>Adicionar Voluntário</p>
                </div>
            </a>
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
        <div class="clear"></div>
    </div>
    <h2><?= $this->title ?></h2>

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

