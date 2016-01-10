<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Pacote;
use app\models\Evento;
use app\models\ItemProgramacao;
use app\models\ItemProgramacaoHasPacote;
use app\models\ItemProgramacaoHasPacoteSearch;
use app\models\ItemProgramacaoSearch;
use app\models\PacoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * PacoteController implements the CRUD actions for Pacote model.
 */
class PacoteController extends Controller
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
     * Lists all Pacote models.
     * @return mixed
     */
    public function actionIndex($idevento){

        $searchModel = new PacoteSearch();
        $dataProvider = $searchModel->searchEvento(Yii::$app->request->queryParams);
        $evento = Evento::findOne($idevento);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'evento' => $evento,
        ]);
    }

    /**
     * Displays a single Pacote model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id){

        $searchModel = new PacoteSearch();
        $dataProvider = $searchModel->searchItemProgramacaoPacote($id);

        $model = $this->findModel($id);
        $model->valor = $model->valor;
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Pacote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idevento)
    {
        $this->autorizaUsuario($idevento);
        
        $itemProgramacaoSearch = new ItemProgramacaoSearch();
        $itensProgramacao = ArrayHelper::map($itemProgramacaoSearch->search(['idevento' => $idevento])->getModels(), 'iditemProgramacao', 'titulo');

        $model = new Pacote();
        $model->evento_idevento = $idevento;
        $evento = Evento::findOne($idevento);
        $model->status = '1';
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $this->mensagens('success', 'Pacote Cadastrado', 'Pacote cadastrado com sucesso');
                return $this->redirect(['index', 'idevento' => $model->evento_idevento]);
            }else{
                return $this->render('create', [
                    'model' => $model, 
                    'itensProgramacao' => $itensProgramacao,
                    'evento' => $evento,             
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model, 
                'itensProgramacao' => $itensProgramacao,
                'evento' => $evento,               
            ]);
        }
    }

    /**
     * Updates an existing Pacote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id){

        $model = $this->findModel($id);
        $this->autorizaUsuario($model->evento_idevento);
        $evento = Evento::findOne($model->evento_idevento);
        
        /*Inicio da obtenção de um array com os ids e descricões de todos os itens de Programação*/
        $itemProgramacaoSearch = new ItemProgramacaoSearch();
        $itensProgramacao = ArrayHelper::map($itemProgramacaoSearch->search(['idevento' => $model->evento_idevento])->getModels(), 'iditemProgramacao', 'titulo');
        /*Fim da obtenção*/

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $this->mensagens('success', 'Pacote Aterado', "Pacote \"$model->titulo\"foi Alterado com Sucesso");
                
            }else{
                $this->mensagens('danger', 'Pacote Não Aterado', "Erro ao Alterar Pacote \"$model->titulo\"");
            }
            return $this->redirect(['index', 'idevento' => $model->evento_idevento]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'itensProgramacao' => $itensProgramacao,
                'evento' => $evento,
            ]);
        }
    }

    /**
     * Deletes an existing Pacote model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->autorizaUsuario($model->evento_idevento);

        $model = $this->findModel($id);
        $idevento = $model->evento_idevento;
        $pacoteDescricao = $model->descricao;
        if($model->delete()){
             $this->mensagens('success', 'Pacote Removido', "O pacote \"$pacoteDescricao\" foi removido com Sucesso");
        }else{
            $this->mensagens('danger', 'Pacote não removido', "Erro ao remover o pacote \"$pacoteDescricao\"");
        }

        return $this->redirect(['index', 'idevento' => $idevento]);
    }

    /**
     * Finds the Pacote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pacote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pacote::findOne($id)) !== null) {
            $model->setItemProgramacaoPacote();
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


    /*Tipo: sucess, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'duration' => 1000,
            'icon' => 'home',
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'bottom',
            'positonX' => 'right'
        ]);
    }
}

