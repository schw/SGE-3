<?php

namespace app\controllers;

use Yii;
use app\models\Inscreve;
use app\models\InscreveSearch;
// adicionado estes dois:
use app\models\EventoSearch;
use app\models\Evento;
// fim
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InscreveController implements the CRUD actions for Inscreve model.
 */
class InscreveController extends Controller
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
     * Lists all Inscreve models.
     * @return mixed
     */
    public function actionIndex()
    {
        /* isso era antes:
        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         fim do era antes ---- */


        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    /**
     * Displays a single Inscreve model.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return mixed
     */
    // se der erro, tire isto: -> public function actionView($usuario_idusuario, $evento_idevento)
    public function actionView($id)
    {
        //return $this->render('view', [
        //    'model' => $this->findModel($usuario_idusuario, $evento_idevento),
        //]);

        $model = $this->findModel($id);
        $model->dataIni = date("d-m-Y", strtotime($model->dataIni));
        $model->dataFim = date("d-m-Y", strtotime($model->dataFim));
        return $this->render('view', [
            'model' => $model,
        ]);

    }

    /**
     * Creates a new Inscreve model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inscreve();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'usuario_idusuario' => $model->usuario_idusuario, 'evento_idevento' => $model->evento_idevento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inscreve model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return mixed
     */
    public function actionUpdate($usuario_idusuario, $evento_idevento)
    {
        $model = $this->findModel($usuario_idusuario, $evento_idevento);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'usuario_idusuario' => $model->usuario_idusuario, 'evento_idevento' => $model->evento_idevento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inscreve model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return mixed
     */
    public function actionDelete($usuario_idusuario, $evento_idevento)
    {
        $this->findModel($usuario_idusuario, $evento_idevento)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inscreve model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return Inscreve the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
