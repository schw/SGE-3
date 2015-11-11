<?php

namespace app\controllers;

use Yii;
use app\models\Inscreve;
use app\models\InscreveSearch;
use app\models\User;
// adicionado estes quatro:
use app\models\EventoSearch;
use app\models\Evento;
use app\models\ItemProgramacao;
use app\models\ItemProgramacaoSearch;
// fim
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * InscreveController implements the CRUD actions for Inscreve model.
 */
class InscritosController extends Controller
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
     * Displays a single Inscreve model.
     * @param integer $usuario_idusuario
     * @param integer $evento_idevento
     * @return mixed
     */
    
    public function actionView($id)
    {
    
        $model = $this->findModel($id);
        $model->dataIni = date("d-m-Y", strtotime($model->dataIni));
        $model->dataFim = date("d-m-Y", strtotime($model->dataFim));
        return $this->render('view', [
            'model' => $model,
        ]);

    }


    public function actionIndex()
    {
        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->searchInscritos(Yii::$app->request->queryParams);

        $query = InscreveSearch::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        //$credenciado = $query->select('usuario_idusuario, credenciado')
        //    ->from('inscreve')
        //    ->where(['evento_idevento' => '$idevento'] AND ['credenciado' => '1'])
        //    ->offset($pagination->offset)
        //    ->limit($pagination->limit)
        //    ->all();

        //$credenciado = $query->select([
        //    'user.nome AS Nome',
        //    'inscreve.credenciado AS Credenciado']) 
        //->from('user')
        //->join('INNER JOIN',
        //        'inscreve',
        //        'inscreve.usuario_idusuario = user.idusuario'
        //);

        //$command = $query->createCommand();
        //$data = $command->queryAll();  

        return $this->render('index', [
            //'credenciado' => $credenciado,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pagination' => $pagination,
        ]);
    }

    public function actionCredenciar()
    {

        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $id_usuario = Yii::$app->user->identity->idusuario;
        $id_evento = Yii::$app->request->post('evento_idevento');


        $sql = "UPDATE inscreve SET credenciado = '1' WHERE usuario_idusuario = '$id_usuario' AND evento_idevento = '$id_evento'";
        
        try{
            echo Yii::$app->db->createCommand($sql)->execute();
        }
        catch(\Exception $e){

            Yii::$app->session->setFlash('Falha', 'Você já está credenciado neste evento');
            return Yii::$app->getResponse()->redirect(array('/inscreve/', 'mensagem' =>'erro'));
        }

            Yii::$app->session->setFlash('Sucesso', 'Credenciamento realizado com sucesso');
            return Yii::$app->getResponse()->redirect(array('/inscreve/','mensagem' =>'sucesso'));
    }



    public function actionProgramacao()
    {

        $searchModel = new ItemProgramacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('programacao', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

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
