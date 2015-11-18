<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voluntario".
 *
 * @property integer $idvoluntario
 * @property string $nome
 * @property string $email
 * @property string $cracha
 * @property string $instituicao
 *
 * @property EventoHasVoluntario[] $eventoHasVoluntarios
 * @property Evento[] $eventoIdeventos
 */
class Voluntario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'voluntario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'cracha'], 'required'],
            [['nome'], 'string', 'max' => 50],
            [['email', 'cracha', 'instituicao'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idvoluntario' => 'Idvoluntario',
            'nome' => 'Nome',
            'email' => 'Email',
            'cracha' => 'Cracha',
            'instituicao' => 'Instituicao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoHasVoluntarios()
    {
        return $this->hasMany(EventoHasVoluntario::className(), ['voluntario_idvoluntario' => 'idvoluntario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoIdeventos()
    {
        return $this->hasMany(Evento::className(), ['idevento' => 'evento_idevento'])->viaTable('evento_has_voluntario', ['voluntario_idvoluntario' => 'idvoluntario']);
    }
}
