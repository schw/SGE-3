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
        $query = Evento::find()->where("dataFim > '". date('Y-m-d')."'");

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
     * Busca Todos os Eventos do usuário autenticado criando uma instância data provider.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchEventosResponsavel($status){
        if ($status == 'passado') {
            $query = Evento::find()->select(['*','COUNT(inscreve.evento_idevento) AS qtd_evento'])->
            where("dataFim < '". date('Y-m-d')."'")->joinWith("inscreve")->
                andWhere(['responsavel' => Yii::$app->user->identity->idusuario])->groupBy('sigla');


        }else{
            $query = Evento::find()->select(['*','COUNT(inscreve.evento_idevento) AS qtd_evento'])->
            where("dataFim >= '". date('Y-m-d')."'")->joinWith("inscreve")->
                andWhere(['responsavel' => Yii::$app->user->identity->idusuario])->groupBy('sigla');

        }

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

    public function searchEventosCoodenadores($status){

        if ($status == 'passado') {
            $query = CoordenadorHasEvento::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])
                ->andWhere("evento.dataFim < '". date('Y-m-d')."'");
        }else{
            $query = CoordenadorHasEvento::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])
                ->andWhere("evento.dataFim >= '". date('Y-m-d')."'");
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