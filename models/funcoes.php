<?php
	public class funcoes{

		public function acesso($eventoDataFim, $idEvento){
			return date("Y-m-d", strtotime($eventodataFim)) > date('Y-m-d') && (Yii::$app->user->identity->idusuario == $this->responsavel || 
	            CoordenadorHasEvento::find()->where(['usuario_idusuario' => Yii::$app->user->identity->idusuario])->andWhere(['evento_idevento' => $idevento])->count()) ? true : false;
		}
	}



?>