<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Voluntario;

/**
 * VoluntarioSearch represents the model behind the search form about `app\models\Voluntario`.
 */
class VoluntarioSearch extends Voluntario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idvoluntario'], 'integer'],
            [['nome', 'email', 'cracha', 'instituicao'], 'safe'],
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
        $query = Voluntario::find();

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
            'idvoluntario' => $this->idvoluntario,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'cracha', $this->cracha])
            ->andFilterWhere(['like', 'instituicao', $this->instituicao]);

        return $dataProvider;
    }
}
