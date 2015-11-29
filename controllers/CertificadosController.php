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

class CertificadosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new InscreveSearch();
        $dataProvider = $searchModel->searchCredenciados(Yii::$app->request->queryParams);
        $dataProvider2 = $searchModel->searchPalestrantes(Yii::$app->request->queryParams);
        $dataProvider3 = $searchModel->searchVoluntarios(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'dataProvider3' => $dataProvider3,

        ]);
    }

}
