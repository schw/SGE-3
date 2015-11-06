<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "local".
 *
 * @property integer $idlocal
 * @property string $descricao
 * @property string $latitude
 * @property string $longitude
 *
 * @property Evento[] $eventos
 * @property ItemProgramacao[] $itemProgramacaos
 */
class Local extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'local';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'latitude', 'longitude'], 'required'],
            [['descricao', 'latitude', 'longitude'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idlocal' => 'Idlocal',
            'descricao' => 'Descrição',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['local_idlocal' => 'idlocal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaos()
    {
        return $this->hasMany(ItemProgramacao::className(), ['local_idlocal' => 'idlocal']);
    }
}
