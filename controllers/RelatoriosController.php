<?php

namespace app\controllers;
use app\models\User;
use app\models\Relatorios;
use app\models\Evento;
use yii\web\ForbiddenHttpException;
use Yii;
use mPDF;


class RelatoriosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->autorizaUsuario();
        return $this->render('index');
    }

    public function converterMes($current){
        $mes_numero = (date('m',strtotime($current)));

        $mes = array ("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho",
        "Agosto","Setembro","Outubro","Novembro","Dezembro");


        return $mes[$mes_numero-1];
    }

//função necessária p/ gerar certificados, pois delimita o período inicial e final do evento
   public function tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim){
        
        if($mes_inicio == $mes_fim && $ano_inicio == $ano_fim){

            $tag = '<b> '. $dia_inicio .' a '.$dia_fim .' de '.$mes_fim.'
                de '.$ano_fim.'</b>';
        }
        else if($mes_inicio != $mes_fim && $ano_inicio == $ano_fim){
            $tag = '<b> '. $dia_inicio .' de '.$mes_inicio.'
                a '.$dia_fim .' de '.$mes_fim.'
                de '.$ano_fim.'</b>';
        }

        else{

            $tag = '<b> '. $dia_inicio .' de '.$mes_inicio.'
                de '.$ano_inicio.' a '.$dia_fim .' de '.$mes_fim.'
                de '.$ano_fim.'</b>';

        }

            return $tag;
    }


    public function actionCoordpdf() {
 
        $datainicial = $_GET['datainicial'];
        $datafinal = $_GET['datafinal'];

        //$tag = $this->tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim);

            //inicio da tabela
            $inicio = '<table border="1" align = "center">
                    <tr>
                    <th width = "550px">Coordenador de Evento</th>
                    <th width = "100px">Quantidade de Eventos</th>
                    </tr>
            ';

        $relatorio = new User();
        $model = $relatorio->getCoordenadoresEventos($datainicial,$datafinal);//obtendo model dos coordenadores de eventos
        $qtd_rows = count($model); //quantidade de rows

        
        $current = date('Y/m/d');

        $currentTime = strtotime($current);

        $mes = $this->converterMes($current);

        $data ='Manaus, '.date('d', $currentTime).' de '. $mes. ' de '. 
            date('Y', $currentTime).'.';

        return $this->render('coord', [
            'model' => $model,
            'data' => $data,
        ]);

    }

    public function actionParticpdf() {

        $datainicial = $_GET['datainicial'];
        $datafinal = $_GET['datafinal'];

        //$tag = $this->tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim);

            //inicio da tabela
            $inicio = '<table border="1" align = "center">
                    <tr>
                    <th width = "550px">Participante</th>
                    <th width = "100px">Quantidade de Inscrições</th>
                    </tr>
            ';

        $relatorio = new User();
        $model = $relatorio->getParticipantesEventos($datainicial,$datafinal);//obtendo model dos coordenadores de eventos
        $qtd_rows = count($model); //quantidade de rows

        
        $current = date('Y/m/d');

        $currentTime = strtotime($current);

        $mes = $this->converterMes($current);

        $data ='Manaus, '.date('d', $currentTime).' de '. $mes. ' de '. 
            date('Y', $currentTime).'.';

        return $this->render('partic', [
            'model' => $model,
            'data' => $data,
        ]);

    }

    public function actionEventopdf() {


        $datainicial = $_GET['datainicial'];
        $datafinal = $_GET['datafinal'];

        //$tag = $this->tag($dia_inicio,$mes_inicio,$ano_inicio,$dia_fim,$mes_fim,$ano_fim);

            //inicio da tabela
            $inicio = '<table border="1" align = "center">
                    <tr>
                    <th width = "550px">Sigla do Evento</th>
                    <th width = "100px">Quantidade de Inscricoes</th>
                    </tr>
            ';

        $relatorio = new Evento();
        $model = $relatorio->getInscritosEventos($datainicial,$datafinal);//obtendo model dos coordenadores de eventos
        $qtd_rows = count($model); //quantidade de rows

        
        $current = date('Y/m/d');

        $currentTime = strtotime($current);

        $mes = $this->converterMes($current);

        $data ='Manaus, '.date('d', $currentTime).' de '. $mes. ' de '. 
            date('Y', $currentTime).'.';

        return $this->render('evento', [
            'model' => $model,
            'data' => $data,
        ]);

    }

    protected function autorizaUsuario(){
        if(Yii::$app->user->isGuest || Yii::$app->user->identity->tipoUsuario == 3){
            $this->redirect(['evento/index']);
        }
    }


}
