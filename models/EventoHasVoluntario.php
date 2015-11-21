<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento_has_voluntario".
 *
 * @property string $evento_idevento
 * @property integer $voluntario_idvoluntario
 *
 * @property Evento $eventoIdevento
 * @property Voluntario $voluntarioIdvoluntario
 */
class EventoHasVoluntario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evento_has_voluntario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evento_idevento', 'voluntario_idvoluntario'], 'required'],
            [['evento_idevento', 'voluntario_idvoluntario'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'evento_idevento' => 'Evento',
            'voluntario_idvoluntario' => 'Voluntário',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoIdevento()
    {
        return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoluntarioIdvoluntario()
    {
        return $this->hasOne(Voluntario::className(), ['idvoluntario' => 'voluntario_idvoluntario']);
    }

    public function getEvento()
    {
        return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
    }

    public function getVoluntario()
    {
        return $this->hasOne(Voluntario::className(), ['idvoluntario' => 'voluntario_idvoluntario']);
    }
}
