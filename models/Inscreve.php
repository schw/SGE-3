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
            [['usuario_idusuario', 'evento_idevento', 'pacote_idpacote', 'credenciado'], 'integer'],
            
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
            'pacote_idpacote' => 'Pacote Idpacote',
            'credenciado' => 'Credenciado',
            'usuario.nome' => 'Nome',
            'pacote.titulo' => 'Pacote',
            'evento.tipo.titulo' => 'Tipo',
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

        public function getPacote()
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

    public function getEvento()
    {
        return $this->hasOne(Evento::className(), ['idEvento' => 'evento_idevento']);
    }

    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['idusuario' => 'usuario_idusuario']);
    }


public function inscrever($id_evento)
    {
        $id_usuario = Yii::$app->user->identity->idusuario;

        $sql = "INSERT INTO inscreve VALUES ('$id_usuario','$id_evento',0,NULL)";
        
            $resultado = Yii::$app->db->createCommand($sql)->execute();

        return $resultado;
    }

public function inscreverComPacote($id_evento,$id_pacote)
    {
        $id_usuario = Yii::$app->user->identity->idusuario;

        $sql = "INSERT INTO inscreve VALUES ('$id_usuario','$id_evento',0,'$id_pacote')";
        
            $resultado = Yii::$app->db->createCommand($sql)->execute();

        return $resultado;
    }

//reduzir vagas da tabela evento
public function reduzir_vagas_evento($id_evento){

    $sql = "update evento set
        vagas = vagas -1 
        where idevento = $id_evento";

        $resultado = Yii::$app->db->createCommand($sql)->execute();

        return $resultado;
}


//funcao abaixo usada para reduzir as vagas da tabela item de programacao
public function reduzirVagas($id_pacote , $id_evento,$opcao)
    {

        if($opcao == 1) {
        //reduzir vaga da tabela itens-programacao e TAMBÉM da tabela evento
        $sql = "update itemProgramacao as i, evento as e 
            set i.vagas = i.vagas -1 , e.vagas = e.vagas -1 
            where i.evento_idevento = $id_evento AND e.idevento = $id_evento";
            $resultado = Yii::$app->db->createCommand($sql)->execute();
        }

        else{
            //reduzir vagas da tabela item-programacao (relacionados a um pacote)
        $sql = "update itemProgramacao set vagas = vagas -1 where iditemProgramacao in (
                select itemProgramacao_iditemProgramacao from itemProgramacao_has_pacote 
                as item join pacote as p on item.pacote_idpacote = p.idpacote 
                where idpacote =".$id_pacote.")";

            $resultado = Yii::$app->db->createCommand($sql)->execute();
            $result = new Inscreve;

            //linha abaixo para reduzir vagas da tabela EVENTO !
            $resultado = $resultado + $result->reduzir_vagas_evento($id_evento);
        }
        
        return $resultado;
    }

}
