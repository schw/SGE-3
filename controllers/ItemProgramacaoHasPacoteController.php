<?php

namespace app\controllers;

use Yii;
use app\models\ItemProgramacaoHasPacote;
use app\models\ItemProgramacaoHasPacoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemProgramacaoHasPacoteController implements the CRUD actions for ItemProgramacaoHasPacote model.
 */
class ItemProgramacaoHasPacoteController extends Controller
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
     * Lists all ItemProgramacaoHasPacote models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemProgramacaoHasPacoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemProgramacaoHasPacote model.
     * @param integer $itemProgramacao_iditemProgramacao
     * @param string $pacote_idpacote
     * @return mixed
     */
    public function actionView($itemProgramacao_iditemProgramacao, $pacote_idpacote)
    {
        return $this->render('view', [
            'model' => $this->findModel($itemProgramacao_iditemProgramacao, $pacote_idpacote),
        ]);
    }

    /**
     * Creates a new ItemProgramacaoHasPacote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemProgramacaoHasPacote();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'itemProgramacao_iditemProgramacao' => $model->itemProgramacao_iditemProgramacao, 'pacote_idpacote' => $model->pacote_idpacote]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ItemProgramacaoHasPacote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $itemProgramacao_iditemProgramacao
     * @param string $pacote_idpacote
     * @return mixed
     */
    public function actionUpdate($itemProgramacao_iditemProgramacao, $pacote_idpacote)
    {
        $model = $this->findModel($itemProgramacao_iditemProgramacao, $pacote_idpacote);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'itemProgramacao_iditemProgramacao' => $model->itemProgramacao_iditemProgramacao, 'pacote_idpacote' => $model->pacote_idpacote]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ItemProgramacaoHasPacote model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $itemProgramacao_iditemProgramacao
     * @param string $pacote_idpacote
     * @return mixed
     */
    public function actionDelete($itemProgramacao_iditemProgramacao, $pacote_idpacote)
    {
        $this->findModel($itemProgramacao_iditemProgramacao, $pacote_idpacote)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemProgramacaoHasPacote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $itemProgramacao_iditemProgramacao
     * @param string $pacote_idpacote
     * @return ItemProgramacaoHasPacote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($itemProgramacao_iditemProgramacao, $pacote_idpacote)
    {
        if (($model = ItemProgramacaoHasPacote::findOne(['itemProgramacao_iditemProgramacao' => $itemProgramacao_iditemProgramacao, 'pacote_idpacote' => $pacote_idpacote])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
