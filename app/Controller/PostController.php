<?php

class PostController{
    public function index($params){

        try{
        $postagem = Postagem::selecionaPorId($params);
            var_dump($postagem);
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

          $parametros = array();
          $parametros['ttulo'] = $postagem->conteudo;

          
          $conteudo = $template->render($parametros);
          echo $conteudo;


        }catch(Exception $e){
            echo $e->getMessage();
        }


    
    }
}