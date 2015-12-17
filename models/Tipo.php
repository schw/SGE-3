<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo".
 *
 * @property integer $idtipo
 * @property string $titulo
 *
 * @property Evento[] $eventos
 * @property ItemProgramacao[] $itemProgramacaos
 */
class Tipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['titulo'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtipo' => 'Idtipo',
            'titulo' => '*Título',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['tipo_idtipo' => 'idtipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaos()
    {
        return $this->hasMany(ItemProgramacao::className(), ['tipo_idtipo' => 'idtipo']);
    }

}
