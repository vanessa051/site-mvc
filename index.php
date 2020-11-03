<?php
require_once('app/Model/Connection.php');
require_once('app/Core/InfernoDoCore.php');
require_once('app/Controller/HomeController.php');
require_once('app/Controller/ErroController.php');
require_once('app/Controller/PostController.php');
require_once('app/Controller/SobreController.php');
require_once('app/Model/Postagem.php');
require_once('app/Model/Comentario.php');
require_once('vendor/autoload.php');

$template = file_get_contents('app/Template/template.html');


//METODO QUE PEGA O RETORNO DA FUNÇÃO START()
ob_start();
$core = new InfernoDoCore;
$core->start($_GET);
$saida = ob_get_contents();
ob_clean();

//SUBSTITUI A VARIAVEL {{AREA_DINAMICA}} QUE ESTÁ NO INDEX PELO RETORNO DO METODO ANTERIOR
$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);
echo $tplPronto;

