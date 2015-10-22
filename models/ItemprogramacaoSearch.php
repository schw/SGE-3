<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Itemprogramacao;

/**
 * ItemprogramacaoSearch represents the model behind the search form about `app\models\Itemprogramacao`.
 */
class ItemprogramacaoSearch extends Itemprogramacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iditemProgramacao', 'vagas', 'cagaHoraria', 'local_idlocal', 'evento_idevento', 'tipo_idtipo'], 'integer'],
            [['titulo', 'descricao', 'palestrante', 'data', 'hora', 'detalhe', 'notificacao'], 'safe'],
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
        $query = Itemprogramacao::find();

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
            'iditemProgramacao' => $this->iditemProgramacao,
            'hora' => $this->hora,
            'vagas' => $this->vagas,
            'cagaHoraria' => $this->cagaHoraria,
            'local_idlocal' => $this->local_idlocal,
            'evento_idevento' => $this->evento_idevento,
            'tipo_idtipo' => $this->tipo_idtipo,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'palestrante', $this->palestrante])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'detalhe', $this->detalhe])
            ->andFilterWhere(['like', 'notificacao', $this->notificacao]);

        return $dataProvider;
    }
}
