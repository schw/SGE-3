<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coordenador_has_evento".
 *
 * @property integer $usuario_idusuario
 * @property integer $evento_idevento
 */
class CoordenadorHasEvento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coordenador_has_evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_idusuario', 'evento_idevento'], 'required'],
            [['usuario_idusuario', 'evento_idevento'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario_idusuario' => '*Coordenador',
            'evento_idevento' => 'Evento',
        ];
    }

    public function getEvento($value=''){
        return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
    }

    public function getUsuario($value=''){
        return $this->hasOne(User::className(), ['idusuario' => 'usuario_idusuario']);
    }
}
