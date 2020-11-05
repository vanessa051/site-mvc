<?php

class Comentario{
    public static function selecionarComentarios($idPost){
        $con = Connection::getConn();

        $sql = "SELECT * FROM comentario WHERE id_msg = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = array();

        while($row = $sql->fetchObject('Comentario')){
            $resultado[] = $row;
        }

        return $resultado;
    }

    public static function inserir($reqPost){
        $con = Connection::getConn();

        $sql = "INSERT INTO comentario (nome, mensagem, id_msg) VALUES (:nom, :msg, :id)";
        $sql = $con->prepare($sql);
        $sql->bindValue(':nom', $reqPost['nome']);
        $sql->bindValue(':msg', $reqPost['msg']);
        $sql->bindValue(':id', $reqPost['id'], PDO::PARAM_INT);
        $sql->execute();

        if($sql->rowCount()){
            return true;
        }

        throw new Exception("Falha na inserção", 1);
        
    }
}