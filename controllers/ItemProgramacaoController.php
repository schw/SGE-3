<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\ItemProgramacao;
use app\models\Evento;
use app\models\Local;
use app\models\Tipo;
use app\models\Palestrante;
use app\models\ItemProgramacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\funcoes;
use yii\db\IntegrityException;
use yii\base\Exception;


/**
 * ItemProgramacaoController implements the CRUD actions for ItemProgramacao model.
 */
class ItemProgramacaoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ItemProgramacao models.
     * @return mixed
     */
    public function actionIndex($idevento){

        $itemProgramacaoSearch = new ItemProgramacaoSearch();
        $itensProgramacaoBanco = $itemProgramacaoSearch->search(['idevento' => $idevento])->getModels();
        $itensProgramacaoCalendar = array();
        $evento = Evento::findOne($idevento);

        foreach($itensProgramacaoBanco as $itemProgramacao){
            $itemProgramacaoCalendar = new \yii2fullcalendar\models\Event();
            $itemProgramacaoCalendar->id = $itemProgramacao->iditemProgramacao;
            $itemProgramacaoCalendar->title = $itemProgramacao->titulo;
            $itemProgramacaoCalendar->start = $itemProgramacao->data."T".$itemProgramacao->hora;
            $itemProgramacaoCalendar->end = $itemProgramacao->data."T".$itemProgramacao->horaFim;
            $itemProgramacaoCalendar->id = $itemProgramacao->iditemProgramacao;
            $itensProgramacaoCalendar[] = $itemProgramacaoCalendar;
        }

        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');

        return $this->render('index', [
            'itensProgramacaoCalendar' => $itensProgramacaoCalendar,
            'arrayTipo' => $arrayTipo,
            'arrayLocal' => $arrayLocal,
            'evento' => $evento,
        ]);
    }

    /**
     * Displays a single ItemProgramacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id){
        
        $this->validaAjax();
        $model = $this->findModel($id);
        $evento = Evento::findOne($model->evento_idevento);
        $model->data = date("d-m-Y", strtotime($model->data));
        if(!$model->detalhe)
                $model->detalhe = "Nenhum";

        return $this->renderAjax('view', [
            'model' => $model,
            'evento' => $evento,
        ]);
    }

    /**
     * Creates a new ItemProgramacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->validaAjax();
        $this->autorizaUsuario(Yii::$app->request->get('idevento'));

        $model = new ItemProgramacao();
        $model->notificacao = '1';

        $model->evento_idevento = Yii::$app->request->get('idevento');
        $model->data = filter_input(INPUT_GET, 'data');
        $model->hora = filter_input(INPUT_GET, 'hora');
        $model->horaFim = filter_input(INPUT_GET, 'horafim');

        if($model->horaFim == null)
            $model->horaFim = date('H:i', strtotime('+2 hour', strtotime($model->hora)));

        if(!$model->tipo_idtipo = filter_input(INPUT_GET, 'tipo'))
            if ($tipo = filter_input(INPUT_GET, 'titulo')){
                $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
                $model->tipo_idtipo = array_search($tipo, $arrayTipo);
            }else
                return $this->redirect(['index', 'idevento' => $model->evento_idevento]);
            
        $arrayPalestrante = ArrayHelper::map(Palestrante::find()->all(), 'idPalestrante', 'nome');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');
        
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){                
                $this->mensagens('success', "Item '".$model->titulo."' foi Adicionado", 'O Item de Programação foi Adicionado com Sucesso');
                return $this->redirect(['index', 'idevento' => $model->evento_idevento]);
            }else{
                $this->mensagens('danger',"Item '".$model->titulo."' Não Adicionado", 'Houve um erro ao adicionar Item de Programacão. Verique os dados iformados e tente novamente');
                return $this->redirect(['index', 'idevento' => $model->evento_idevento]);
            }
        } else {
            
            return $this->renderAjax('create', [
                'model' => $model,
                'arrayLocal' => $arrayLocal,
                'arrayPalestrante' => $arrayPalestrante,
            ]);
        }
    }

    /**
     * Updates an existing ItemProgramacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id){

        $model = $this->findModel($id);
        $this->autorizaUsuario($model->evento_idevento);

        $arrayPalestrante = ArrayHelper::map(Palestrante::find()->all(), 'idPalestrante', 'nome');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idevento' => $model->evento_idevento]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'arrayLocal' => $arrayLocal,
                'arrayPalestrante' => $arrayPalestrante,
            ]);
        }
    }

    /**
     * Deletes an existing ItemProgramacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id){
        
        $model = $this->findModel($id);
        $this->autorizaUsuario($model->evento_idevento);
        $itemProgramacao = $model->titulo;

        try{
            $idevento = $model->evento_idevento;
            $model->delete();
            $this->mensagens('success', 'Item de Programação removido', 'Item de Programacão '.$itemProgramacao.' removido com sucesso');
        }catch(IntegrityException $e){
            $this->mensagens('danger', 'Item de Programação não removido', 'Houve um erro ao remover \''.$itemProgramacao.'\'');
        }

        return $this->redirect(['index', 'idevento' => $idevento]);
    }

    /**
     * Finds the ItemProgramacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemProgramacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemProgramacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findEvento($idevento){

        if($evento = Evento::findOne($idevento)){
            $evento['descricao'] = Evento::findOne($idevento)->descricao;
            $evento['idevento'] = $idevento;
            return $evento;
        }else
            throw new NotFoundHttpException('Página não Encontrada');
    }

    protected function autorizaUsuario($idevento){
        if(Yii::$app->user->isGuest || Yii::$app->user->identity->tipoUsuario == 3 || Yii::$app->user->identity->tipoUsuario == 2)
            return $this->redirect(['index', 'idevento' => $idevento]);
        
        $evento = $this->findEvento($idevento);
        if(!$evento->canAccess())
            return $this->redirect(['index']);
    }

    protected function validaAjax(){
        if(Yii::$app->request->get('requ') != 'AJAX')
            throw new NotFoundHttpException("A página solicitada não foi encontrada");
    }

    /*Tipo: success, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'duration' => 5000,
            'icon' => 'home',
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'bottom',
            'positonX' => 'right'
        ]);
    }
}
