<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Local */
/* @var $form yii\widgets\ActiveForm */
?>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>
</head>
	<style>
		#mapCanvas {
			width: 100%;
			height: 450px !important;
			float: left;
			margin-bottom: 20px;
		}
		
		#infoPanel {
			float: left;
			margin-left: 10px;
		}
	</style>
<div id="conteudo">
	<div id="mapCanvas"></div>
	<div class="local-form" style="margin-top: 10px;">
		<?= Html::activeTextInput($model, 'idlocal',['style'=>"display:none;", 'id'=>'id'])?>
		<?= Html::activeLabel($model, 'Nome')?>
		<?= Html::activeTextInput($model, 'descricao',['maxlength'=>'49','id'=>'nome','placeholder'=>'Nome do local',
				'style'=>"width:400px;"]);?>
		<br>
		<?= Html::button('Salvar',['onclick'=>"botao()",'class' => 'btn btn-primary']);?>
	</div>
</div>

<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
var marker;

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      //updateMarkerAddress(responses[0].formatted_address);
    } else {
      //updateMarkerAddress('Não foi possivel determinar um endereço proximo');
    }
  });
}

function updateMarkerStatus(str) {
  //document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  /*document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
  //window.location.href = "http://localhost/clone/sge3/web/index.php?r=local/create" + "&lat=" + latLng;
  //return getTheMarkerPosition*/
}

function AjaxF()
{
	var ajax;
	
	try
	{
		ajax = new XMLHttpRequest();
	} 
	catch(e) 
	{
		try
		{
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e) 
		{
			try 
			{
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e) 
			{
				alert("Seu browser não da suporte à AJAX!");
				return false;
			}
		}
	}
	return ajax;
}

function AlteraConteudo(latLng)
{
	var ajax = AjaxF();	
	
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4)
		{
			document.getElementById('conteudo').innerHTML = ajax.responseText;
		}
	}
	//window.location.href = "http://localhost/clone/sge3/web/index.php?r=local/create" + "&lat=" + latLng;
	// Variável com os dados que serão enviados ao PHP
	var id = document.getElementById('id').value;
	var lat = latLng.lat();
	var lng = latLng.lng();
	var nome = document.getElementById('nome').value
	if(id != ""){
		//alert(lat+lng+nome+id);
		ajax.open("GET", "index.php?r=local/update&id="+id+"&lat="+lat+"&lng="+lng+"&nome="+nome);
	}else{
		//alert(lat+lng+nome);
		ajax.open("GET", "index.php?r=local/create&lat="+lat+"&lng="+lng+"&nome="+nome);
	}
	ajax.setRequestHeader("Content-Type", "text/html");
	ajax.send();
}


function botao(){
	if(document.getElementById('nome').value === ""){
		alert("Digite um nome para o local");
		return;
	}
	//alert(document.getElementById('nome').value);
	//alert("akiiiii"+" "+marker.getPosition().lat());
	AlteraConteudo(marker.getPosition());
}

function updateMarkerAddress(str) {
  //document.getElementById('address').innerHTML = str;
}

function initialize() {
	var latLng;
	latLng = new google.maps.LatLng(-3.088166335627688, -59.96434260416987);
	var lat = "<?php echo $model->latitude;?>";
	var lng = "<?php echo $model->longitude;?>";
	if(lat !== ""){
		latLng = new google.maps.LatLng(lat, lng);
	}
	var map = new google.maps.Map(document.getElementById('mapCanvas'), {
	  zoom: 15,
	  center: latLng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	marker = new google.maps.Marker({
	  position: latLng,
	  title: 'Point A',
	  map: map,
	  draggable: true
	});

  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  //AlterarConteudo(latLng);
  
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('arrastando...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('arrastando...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('posicionado');
    geocodePosition(marker.getPosition());
    //AlteraConteudo(marker.getPosition());
  });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>
