<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Pacote;
use app\models\ItemProgramacao;
use app\models\ItemProgramacaoHasPacote;
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
    public function actionIndex($id)
    {
        $this->autorizaUsuario();
        $searchModel = new PacoteSearch();
        $dataProvider = $searchModel->searchEvento(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Pacote model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->autorizaUsuario();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pacote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idevento)
    {
        $this->autorizaUsuario();
        $model = new Pacote();
        $model->evento_idevento = $idevento;
        $model->status = '1';
        $itensProgramacao = ArrayHelper::map(ItemProgramacao::find()->all(), 'iditemProgramacao', 'descricao');

        if ($model->load(Yii::$app->request->post())) {    
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->idpacote]);
            }else{
                print_r($model->getErrors());
            }
        } else {
            return $this->render('create', [
                'model' => $model, 
                'itensProgramacao' => $itensProgramacao,               
            ]);
        }
    }

    /**
     * Updates an existing Pacote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->autorizaUsuario();
        $model = $this->findModel($id);
        $itensProgramacao = ArrayHelper::map(ItemProgramacao::find()->all(), 'iditemProgramacao', 'descricao');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idpacote]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'itensProgramacao' => $itensProgramacao,
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
        $this->autorizaUsuario();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function autorizaUsuario(){
        if(Yii::$app->user->isGuest || Yii::$app->user->identity->idusuario == 3){
            throw new ForbiddenHttpException('Acesso Negado!! Recurso disponível apenas para administradores.');
        }
    }
}

