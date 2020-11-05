<?php

class Postagem{
    public static function selecionaTodos(){
        $con = Connection::getConn();
        

        $sql = "SELECT * FROM postagem ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado =array();

        while($row = $sql->fetchObject('Postagem')){
        $resultado[] = $row;
        }

        if(!$resultado){
            throw new Exception("Não foi encontrado registro no banco");
        }

        return $resultado;
    }

    public static function selecionaPorId($idPost){
        $con = Connection::getConn();

        $sql = "SELECT * FROM postagem WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue('id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Postagem');

        if(!$resultado){
            throw new Exception("Não foi encontrado registro no banco");
        }else{
            $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);

            
        }

        return $resultado;

    }

    public static function insert($dadosPost){
        if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])){
            throw new Exception("Preencha todod os canpos", 1);

            return false;
        }

        $con = Connection::getConn();

        $sql = 'INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)';
        $sql = $con->prepare($sql);
        $sql->bindValue(':tit', $dadosPost['titulo']);
        $sql->bindValue(':cont', $dadosPost['conteudo']);
        $resultado = $sql->execute();

        if ($resultado == 0){
            throw new Exception(("Publicação não inserida"));

            return false;
        }

        return true;

        }

        public static function update($params){
            $con = Connection::getConn();

            $sql = "UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':tit', $params['titulo']);
            $sql->bindValue(':cont', $params['conteudo']);
            $sql->bindValue(':id', $params['id']);
            $resultado = $sql->execute();

            if ($resultado == 0){
                throw new Exception(("Publicação não alterada"));
    
                return false;
            }
    
            return true;
        }

        public static function delete($id){
            $con = Connection::getConn();

            $sql = "DELETE FROM postagem WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $id);
            $resultado = $sql->execute();

            if ($resultado == 0){
                throw new Exception(("Falha ao deletar publicação"));
    
                return false;
            }
    
            return true;
        }
}