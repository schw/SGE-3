    <?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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


        <?php if(!Yii::$app->user->isGuest && $model->canAccess() && (Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2)){ ?>
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
            <div style="width: 100px; float: right; padding: 10px;">
                <?php echo Html::a(Html::img('@web/img/add.png'), ['coordenador-has-evento/index','idevento' => $model->idevento], ['width' => '10']) ?>
                <?php echo Html::a('Adicionar Coordenadores', ['coordenador-has-evento/index', 'idevento' => $model->idevento]); ?>
            </div>
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
        else{ ?>
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

<!--
    <p> <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2)){ ?>
        <?= Html::a('Alterar', ['update', 'id' => $model->idevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->idevento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja remover o evento "'.$model->descricao.'" ?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Listar Inscritos', ['inscritos/index', 'evento_idevento' => $model->idevento], ['class' => 'btn btn-success'] ); ?>
        <?php } ?>

        <?php 
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->tipoUsuario == 3){
        
            if(!$inscrito){
                echo Html::a('Inscreva-se', ['inscreve/inscrever'], [
                    'class' => 'btn btn-primary',
                    'data'=>[
                    'method' => 'POST',
                    'params'=>['evento_idevento' => $model->idevento],
                ]
                ]);
            }else{
                echo Html::a('Cancelar Inscrição', ['inscreve/cancelar'], [
                    'class' => 'btn btn-danger',
                    'data'=>[
                    'method' => 'POST',
                    'params'=>['evento_idevento' => $model->idevento],
                ]
                ]);
            }
        }?>

        <?= Html::a('Pacotes', ['pacote/index', 'idevento' => $model->idevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Programação', ['item-programacao/index', 'id' => $model->idevento], ['class' => 'btn btn-primary']) ?>
    </p>
    -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sigla',
            'descricao',
            'dataIni',
            'dataFim',
            'horaIni',
            'horaFim',
            'vagas',
            'cargaHoraria',
            'detalhe',
            'tipo.titulo',
            'local.descricao',
        ],
    ]) ?>
    <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->tipoUsuario == 1 || Yii::$app->user->identity->tipoUsuario == 2)){ ?>
    <h2>QRCode <?= $model->descricao ?></h2>
    <?= Html::img('plugins/getQRCode.php?conteudo_QRCODE='.$model->idevento, ['alt' => 'QRCode', 'id' => 'imgqrcode']) ?>
    <?php } ?>
</div>
</div>

