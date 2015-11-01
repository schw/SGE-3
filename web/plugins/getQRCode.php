<?php
include('phpqrcode/qrlib.php');

$codeContents = $_GET["conteudo_QRCODE"];
//$codeContents = md5($codeContents)."/";
QRcode::png($codeContents,null, QR_ECLEVEL_L , 15);
?>