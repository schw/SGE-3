<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inscreve".
 *
 * @property integer $usuario_idusuario
 * @property integer $evento_idevento
 * @property string $credenciado
 * @property integer $pacote_idpacote
 *
 * @property Evento $eventoIdevento
 * @property Pacote $pacoteIdpacote
 * @property User $usuarioIdusuario
 */
class Inscreve extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inscreve';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_idusuario', 'evento_idevento', ], 'required'],
            [['usuario_idusuario', 'evento_idevento', 'pacote_idpacote'], 'integer'],
            [['credenciado'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario_idusuario' => 'Usuario Idusuario',
            'evento_idevento' => 'Nome do Evento',
            'idtipo' => 'Tipo',
            'credenciado' => 'Credenciado',
            'pacote_idpacote' => 'Pacote Idpacote',
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
    public function getPacoteIdpacote()
    {
        return $this->hasOne(Pacote::className(), ['idpacote' => 'pacote_idpacote']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(User::className(), ['idusuario' => 'usuario_idusuario']);
    }

    //criado por mim:
    public function getEvento()
    {
    return $this->hasOne(Evento::className(), ['idevento' => 'evento_idevento']);
    }

        public function getTipo()
    {
        return $this->hasOne(Tipo::className(), ['idtipo' => 'tipo_idtipo']);
    }

}
