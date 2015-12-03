<?php

namespace app\controllers;

use Yii;
use app\models\Palestrante;
use app\models\PalestranteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PalestranteController implements the CRUD actions for Palestrante model.
 */
class PalestranteController extends Controller
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
     * Lists all Palestrante models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PalestranteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Palestrante model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Palestrante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Palestrante();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $this->mensagens('success', 'Palestrante Cadastrado', 'Palestrante foi Cadastrado com Sucesso');
            }else{
                $this->mensagens('danger', 'Palestrante Não Cadastrado', 'Houve um erro ao adicionar o Palestrante');
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Palestrante model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $this->mensagens('success', 'Palestrante Alterado', 'Palestrante foi Alterado com Sucesso');
            }else{
                $this->mensagens('danger', 'Palestrante Não Alterado', 'Houve um erro ao Alterar o Palestrante');
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Palestrante model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $palestrante = $model->nome;
        try{
            $model->delete();
            $this->mensagens('success', 'Palestrante Removido', 'Palestrante \''.$palestrante.'\' foi removido com sucesso');
        }catch(Exception $e){
            $this->mensagens('danger', 'Palestrante Não Removido', 'Houve um erro ao remover o palestrante \''.$palestrante.'\'');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Palestrante model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Palestrante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Palestrante::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
