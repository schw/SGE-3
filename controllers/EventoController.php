<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Evento;
use app\models\Local;
use app\models\Tipo;
use app\models\EventoSearch;
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
     * Lists all Evento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->autorizaUsuario();
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Evento model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->autorizaUsuario();
        $this->validaEvento($id);       

        $model = $this->findModel($id);
        $model->dataIni = date("d-m-Y", strtotime($model->dataIni));
        $model->dataFim = date("d-m-Y", strtotime($model->dataFim));
        $model->cargaHoraria = $model->cargaHoraria." hs";
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->autorizaUsuario();

        $model = new Evento();
        $model->responsavel = 1;
        $model->allow = 1;
        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');
        
        if ($model->load(Yii::$app->request->post())) {
            $model->imagem = $model->upload(UploadedFile::getInstance($model, 'imagem'));
            
            //if($model->imagem != null){
                $model->save();
                print_r($model->getErrors());
                return $this->redirect(['index']);
            //}
        } else {
            return $this->render('create', [
                'model' => $model,
                'arrayTipo' => $arrayTipo,
                'arrayLocal' => $arrayLocal,
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

        $model = $this->findModel($id);
        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idevento]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'arrayTipo' => $arrayTipo,
                'arrayLocal' => $arrayLocal,
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

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
            throw new NotFoundHttpException('Evento Solicitado não Encontrado.');
        }
    }

    protected function autorizaUsuario(){
        if(Yii::$app->user->isGuest || Yii::$app->user->identity->tipoUsuario == 3){
            throw new ForbiddenHttpException('Acesso Negado!! Recurso disponível apenas para administradores.');
        }
    }

    protected function validaEvento($id){
        if(Evento::find()->where(['responsavel' => Yii::$app->user->identity->idusuario])->andWhere(['idevento' => $id])->count() == 0)
            throw new NotFoundHttpException('Evento Solicitado não Encontrado.');
    }
}
