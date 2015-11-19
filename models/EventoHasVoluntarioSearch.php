<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EventoHasVoluntario;

/**
 * EventoHasVoluntarioSearch represents the model behind the search form about `app\models\EventoHasVoluntario`.
 */
class EventoHasVoluntarioSearch extends EventoHasVoluntario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evento_idevento', 'voluntario_idvoluntario'], 'integer'],
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
    public function search($idevento)
    {
        $query = EventoHasVoluntario::find()->where(['evento_idevento' => $idevento]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'evento_idevento' => $this->evento_idevento,
            'voluntario_idvoluntario' => $this->voluntario_idvoluntario,
        ]);

        return $dataProvider;
    }

    public function searchVoluntarios()
    {
        $query = Voluntario::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'evento_idevento' => $this->evento_idevento,
            'voluntario_idvoluntario' => $this->voluntario_idvoluntario,
        ]);

        return $dataProvider;
    }
}
