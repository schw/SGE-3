<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Itemprogramacao */

$this->title = 'Adicionar Programação';
$this->params['breadcrumbs'][] = ['label' => 'Item de Programação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemprogramacao-create">

    <h1><?= Html::encode($this->title) ?><input type="image" align="right" id ="icone" src="<?php ?>img/icon-voltar.png" onclick="location. href= 'http://localhost/SGE3/web/index.php?r=item-programacao%2Findex&id=<?php echo $model->evento_idevento; ?>'" ></h1>  
   	<br></br>
    <p align="right">Campos marcados com * são obrigatórios</p><div></div>

    <?= $this->render('_form', [
        'model' => $model,
        'arrayTipo' => $arrayTipo,
        'arrayLocal' => $arrayLocal,
    ]) ?>


</div>
