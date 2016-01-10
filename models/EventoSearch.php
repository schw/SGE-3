<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evento;
use app\models\Inscreve;
use app\models\Tipo;

/**
 * EventoSearch represents the model behind the search form about `app\models\Evento`.
 */
class EventoSearch extends Evento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idevento', 'vagas', 'cargaHoraria', 'allow', 'palestrante_idPalestrante', 'local_idlocal', 'tipo_idtipo'], 'integer'],
            [['sigla', 'descricao', 'dataIni', 'dataFim', 'horaIni', 'horaFim', 'imagem', 'detalhe', 'tipo', 'responsavel'],  'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


     /**
     * Busca Todos os Eventos criando uma instância data provider
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchEventos($status){
        //$query = Evento::find()->where("dataFim > '". date('Y-m-d')."'");
        $query = Evento::find()->where("allow = '1' AND dataFim > '". date('Y-m-d')."'")
        ->innerJoin('tipo','evento.tipo_idtipo = tipo.idtipo');
        //mostrando apenas eventos permitidos (com inscricoes abertas)

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['tipo'] = [
        'asc' => ['titulo' => SORT_ASC],
        'desc' => ['titulo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['local'] = [
        'asc' => ['descricao' => SORT_ASC],
        'desc' => ['descricao' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'idevento' => $this->idevento,
            'horaIni' => $this->horaIni,
            'horaFim' => $this->horaFim,
            'vagas' => $this->vagas,
            'cargaHoraria' => $this->cargaHoraria,
            'allow' => $this->allow,
            'responsavel' => $this->responsavel,
        ]);

        $query->andFilterWhere(['like', 'sigla', $this->sigla])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'dataIni', $this->dataIni])
            ->andFilterWhere(['like', 'dataFim', $this->dataFim])
            ->andFilterWhere(['like', 'imagem', $this->imagem])
            ->andFilterWhere(['like', 'detalhe', $this->detalhe])
            ->andFilterWhere(['like', 'tipo.titulo', $this->tipo])
            ->andFilterWhere(['like', 'local.descricao', $this->descricao]);


        return $dataProvider;
    }

    /**
     * Busca os Eventos passados, com incrições abertas ou inscrições que podem ser abertas do usuário autenticado criando uma instância data provider.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchEventosResponsavel($params){
        $status = $params['status'];
        $inscricoes = $params['inscricoes'];

        if ($status == 'passado') {
            $query = Evento::find()->select(['*','COUNT(inscreve.evento_idevento) AS qtd_evento'])->
            where("dataFim < '". date('Y-m-d')."'")->joinWith("inscreve")->
                andWhere(['responsavel' => Yii::$app->user->identity->idusuario])->groupBy('sigla')
                ->innerJoin('tipo','evento.tipo_idtipo = tipo.idtipo');

        }else if($inscricoes == 'fechada'){
            $query = Evento::find()->select(['*','COUNT(inscreve.evento_idevento) AS qtd_evento'])->
            where("dataFim >= '". date('Y-m-d')."'")->andWhere("allow = '0'")->joinWith("inscreve")->
                andWhere(['responsavel' => Yii::$app->user->identity->idusuario])->groupBy('sigla')
                ->innerJoin('tipo','evento.tipo_idtipo = tipo.idtipo');
        }else if($inscricoes == 'naoiniciada'){
            $query = Evento::find()->select(['*','COUNT(inscreve.evento_idevento) AS qtd_evento'])->
            where("dataFim >= '". date('Y-m-d')."'")->andWhere("allow is null")->joinWith("inscreve")->
                andWhere(['responsavel' => Yii::$app->user->identity->idusuario])->groupBy('sigla')
                ->innerJoin('tipo','evento.tipo_idtipo = tipo.idtipo');
        }else{
            $query = Evento::find()->select(['*','COUNT(inscreve.evento_idevento) AS qtd_evento'])->
            where("dataFim >= '". date('Y-m-d')."'")->andWhere("allow = '1'")->joinWith("inscreve")->
                andWhere(['responsavel' => Yii::$app->user->identity->idusuario])->groupBy('sigla')
                ->innerJoin('tipo','evento.tipo_idtipo = tipo.idtipo');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['sigla','descricao','Vagas','Total De Inscritos','tipo.titulo','qtd_evento']]
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $dataProvider->sort->attributes['tipo'] = [
        'asc' => ['titulo' => SORT_ASC],
        'desc' => ['titulo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['local'] = [
        'asc' => ['descricao' => SORT_ASC],
        'desc' => ['descricao' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'idevento' => $this->idevento,
            'horaIni' => $this->horaIni,
            'horaFim' => $this->horaFim,
            'vagas' => $this->vagas,
            'cargaHoraria' => $this->cargaHoraria,
            'allow' => $this->allow,
            'responsavel' => $this->responsavel,
        ]);

        $query->andFilterWhere(['like', 'sigla', $this->sigla])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'dataIni', $this->dataIni])
            ->andFilterWhere(['like', 'dataFim', $this->dataFim])
            ->andFilterWhere(['like', 'imagem', $this->imagem])
            ->andFilterWhere(['like', 'detalhe', $this->detalhe])
            ->andFilterWhere(['like', 'tipo.titulo', $this->tipo])
            ->andFilterWhere(['like', 'local.descricao', $this->descricao]);


        return $dataProvider;
    }

    public function searchEventosCoodenadores($params){
        $status = $params['status'];
        $inscricoes = $params['inscricoes'];

        if ($status == 'passado') {
            $query = CoordenadorHasEvento::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])
                ->andWhere("evento.dataFim < '". date('Y-m-d')."'");

        }else if($inscricoes == 'fechada'){
            $query = CoordenadorHasEvento::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])
                ->andWhere("evento.dataFim >= '". date('Y-m-d')."'")->andWhere("allow = '0'");
        }else if($inscricoes == 'naoiniciada'){
            $query = CoordenadorHasEvento::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])
                ->andWhere("evento.dataFim >= '". date('Y-m-d')."'")->andWhere("allow = 'null'");
        }else{
            $query = CoordenadorHasEvento::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])
                ->andWhere("evento.dataFim >= '". date('Y-m-d')."'")->andWhere("allow = '1'");
        }

        $query->joinWith('evento');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['tipo'] = [
        'asc' => ['titulo' => SORT_ASC],
        'desc' => ['titulo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['local'] = [
        'asc' => ['descricao' => SORT_ASC],
        'desc' => ['descricao' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'idevento' => $this->idevento,
            'horaIni' => $this->horaIni,
            'horaFim' => $this->horaFim,
            'vagas' => $this->vagas,
            'cargaHoraria' => $this->cargaHoraria,
            'allow' => $this->allow,
            'responsavel' => $this->responsavel,
        ]);

        $query->andFilterWhere(['like', 'sigla', $this->sigla])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'dataIni', $this->dataIni])
            ->andFilterWhere(['like', 'dataFim', $this->dataFim])
            ->andFilterWhere(['like', 'imagem', $this->imagem])
            ->andFilterWhere(['like', 'detalhe', $this->detalhe])
            ->andFilterWhere(['like', 'tipo.titulo', $this->tipo])
            ->andFilterWhere(['like', 'local.descricao', $this->descricao]);


        return $dataProvider;
    }
}