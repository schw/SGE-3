<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "palestrante".
 *
 * @property string $idPalestrante
 * @property string $nome
 * @property string $email
 *
 * @property Evento[] $eventos
 * @property ItemProgramacao[] $itemProgramacaos
 */
class Palestrante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'palestrante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 45],
            [['email'], 'unique',]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPalestrante' => 'Id Palestrante',
            'nome' => 'Nome',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['palestrante_idPalestrante' => 'idPalestrante']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemProgramacaos()
    {
        return $this->hasMany(ItemProgramacao::className(), ['palestrante_idPalestrante' => 'idPalestrante']);
    }
}
