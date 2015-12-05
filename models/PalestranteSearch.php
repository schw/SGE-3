<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Palestrante;
use app\models\ItemProgramacao;

/**
 * PalestranteSearch represents the model behind the search form about `app\models\Palestrante`.
 */
class PalestranteSearch extends Palestrante
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPalestrante'], 'integer'],
            [['nome', 'email'], 'safe'],
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
        $query = Palestrante::find();

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
            'idPalestrante' => $this->idPalestrante,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
