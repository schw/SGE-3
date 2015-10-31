<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evento;

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
            [['idevento', 'vagas', 'cargaHoraria', 'allow', 'responsavel'], 'integer'],
            [['sigla', 'descricao', 'dataIni', 'dataFim', 'horaIni', 'horaFim', 'imagem', 'detalhe'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        //Litando apenas Eventos de um determinado professor
        if(isset($params['status']) && $params['status'] == 'passados')
            $statusEvento = "dataFim < '".date('Y-m-d')."'";
        else
            $statusEvento = "dataFim >= '".date('Y-m-d')."'";

        $query = Evento::find()->where(['responsavel' => Yii::$app->user->identity->username])->andwhere($statusEvento);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

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
            ->andFilterWhere(['like', 'detalhe', $this->detalhe]);

        return $dataProvider;
    }
}
