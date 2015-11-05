<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\ItemProgramacao;
use app\models\Local;
use app\models\Tipo;
use app\models\ItemProgramacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
    public function actionIndex()
    {
        $searchModel = new ItemProgramacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemProgramacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ItemProgramacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemProgramacao();
        $model->notificacao = 1;
        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');
        $model->evento_idevento = Yii::$app->request->get('id');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iditemProgramacao]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'arrayTipo' => $arrayTipo,
                'arrayLocal' => $arrayLocal,
            ]);
        }
    }

    /**
     * Updates an existing ItemProgramacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $arrayTipo = ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'titulo');
        $arrayLocal = ArrayHelper::map(Local::find()->all(), 'idlocal', 'descricao');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iditemProgramacao]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'arrayTipo' => $arrayTipo,
                'arrayLocal' => $arrayLocal,
            ]);
        }
    }

    /**
     * Deletes an existing ItemProgramacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
