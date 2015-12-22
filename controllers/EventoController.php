<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Evento;
use app\models\Palestrante;
use app\models\Local;
use app\models\Tipo;
use app\models\EventoSearch;
use app\models\Inscreve;
use app\models\InscreveSearch;
use app\models\PacoteSearch;
use app\models\CoordenadorHasEvento;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller
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
     * Lista Todos os eventos cadastrados. Apenas visualização
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->searchEventos(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lista Eventos para CRUD para o usuário autenticado.
     * @return mixed
     */
    public function actionGerenciareventos()
    {
        $this->autorizaUsuario();
        $status = filter_input(INPUT_GET, 'status');

        if(!$status)
            $status = 'ativo';
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->searchEventosResponsavel($status);
        $dataProvider2 = $searchModel->searchEventosCoodenadores($status);

        if($status == 'passado')
            return $this->render('gerenciarEventos', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataProvider2' => $dataProvider2,
                'status' => 'passado',
            ]);
        else    
            return $this->render('gerenciarEventos', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataProvider2' => $dataProvider2,
                'status' => $status,
            ]);
    }


    /**
     * Displays a single Evento model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$this->autorizaUsuario();
        Yii::$app->user->isGuest ? $verificaInscrito = 0 : 
        
        $verificaInscrito = (new Inscreve())->verificaInscrito
                (Yii::$app->request->queryParams);
        
        $verificaEncerramento = (new Inscreve())->verificaEncerramento
                (Yii::$app->request->queryParams);

        $verificaCredenciamento = (new Inscreve())->verificaCredenciamento
                (Yii::$app->request->queryParams);

        $pacote = (new Inscreve())->possuiPacote
                (Yii::$app->request->queryParams);

        if ($pacote == 0) {
            $verificaVagas = (new Inscreve())->possuiVagasEvento
                (Yii::$app->request->queryParams);
        }
        else{

            $searchModel = new PacoteSearch();
            $verificaVagas = $searchModel->searchEventoPacoteDisponivel($id);
            $verificaVagas = $verificaVagas->getCount();

        }

        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'inscrito' => $verificaInscrito,
            'encerrado' => $verificaEncerramento,
            'credenciamento' => $verificaCredenciamento,
            'existeVagas' => $verificaVagas,
        ]);
    }

    /**
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $this->autorizaUsuario();

        $model = new Evento();
        $model->responsavel = Yii::$app->user->identity->idusuario;
        $model->allow = 1;
        
        $arrayPalestrante = ArrayHelper::map(Palestrante::find()->all(), 'idPalestrante', 'nome');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');
        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        
        
        if ($model->load(Yii::$app->request->post())) {
            $model->imagem = $model->upload(UploadedFile::getInstance($model, 'imagem'));
            if(!$model->save(true))
                return $this->render('create', [
                    'model' => $model,
                    'arrayTipo' => $arrayTipo,
                    'arrayLocal' => $arrayLocal,
                ]);
            else
                return $this->redirect(['evento/gerenciareventos']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'arrayTipo' => $arrayTipo,
                'arrayLocal' => $arrayLocal,
                'arrayPalestrante' => $arrayPalestrante,
            ]);
        }
    }

    /**
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->autorizaUsuario();
        $this->validaEvento($id);

        $model = $this->findModel($id);

        $arrayPalestrante = ArrayHelper::map(Palestrante::find()->all(), 'idPalestrante', 'nome');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');
        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');

        if ($model->load(Yii::$app->request->post())) {
            $model->imagem = $model->upload(UploadedFile::getInstance($model, 'imagem'));
            
            if(!$model->save(true))
                return $this->render('update', [
                    'model' => $model,
                    'arrayTipo' => $arrayTipo,
                    'arrayLocal' => $arrayLocal,
                    'arrayPalestrante' => $arrayPalestrante,
                ]);
            else
                return $this->redirect(['evento/gerenciareventos']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'arrayTipo' => $arrayTipo,
                'arrayLocal' => $arrayLocal,
                'arrayPalestrante' => $arrayPalestrante,
            ]);
        }
    }

    /**
     * Deletes an existing Evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->autorizaUsuario();

        $model = $this->findModel($id);
        
        if($model->delete())
            $this->mensagens('success', 'Pacote Removido', 'Pacote removido com Sucesso');
        else
            $this->mensagens('danger', 'Pacote Não Removido', 'Pacote pode ser Removido');

        return $this->redirect(['gerenciareventos']);
    }

    /**
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Página Solicitada não Encontrada.');
        }
    }

    protected function autorizaUsuario(){
        if(Yii::$app->user->isGuest || Yii::$app->user->identity->tipoUsuario == 3){
            throw new ForbiddenHttpException('Acesso Negado!! Recurso disponível apenas para administradores.');
        }
    }

    protected function validaEvento($id){
        if(Evento::find()->where(['responsavel' => Yii::$app->user->identity->idusuario])->andWhere(['idevento' => $id])->count() == 0 &&
            CoordenadorHasEvento::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])->andWhere(['evento_idevento' => $id])->count() == 0)
                throw new NotFoundHttpException('Evento Solicitado não Encontrado.');
    }

    /*Tipo: success, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'duration' => 1200,
            'icon' => 'home',
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'bottom',
            'positonX' => 'right'
        ]);
    }
}
