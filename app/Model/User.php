<?php

class User{
    public static function selecionaTodos(){
        $con = Connection::getConn();

        // var_dump($con);
        $sql = "SELECT * FROM users ORDER BY id ASC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();
        while($row = $sql->fetchObject('User')){
            $resultado[] = $row;
        }
        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro!");
        }
        return $resultado;
    }
    public static function selecionarPorId($idPost){
        $con = Connection::getConn();

        $sql = "SELECT * FROM users WHERE id = :id";

        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();
        $resultado = $sql->fetchObject('User');
        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco de dados");
        }
        return $resultado;
    }

    public static function insert($dadosPost){
        if(empty($dadosPost['nome']) or empty($dadosPost['user_name']) or empty($dadosPost['senha'])){
            throw new Exception("Preencha todos os campos!");

            return false;
        }
        $con = Connection::getConn();

        $sql = $con->prepare('INSERT INTO users (nome, user_name, senha) VALUES (:nom, :user, :senha)');
        $sql->bindValue(':nom', $dadosPost['nome']);
        $sql->bindValue(':user', $dadosPost['user_name']);
        $sql->bindValue(':senha', $dadosPost['senha']);

        $res = $sql->execute();

        // var_dump($res);
        if ($res == 0) {
            throw new Exception("Falha ao inserir usuário no banco de dados");

            return false;
        }
        return true;
    }

    public static function update($params){
        $con = Connection::getConn();

        $sql = "UPDATE users SET nome = :nome, user_name = :user_name, senha = :senha WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $sql->bindValue(':nome', $params['nome']);
        $sql->bindValue(':user_name', $params['user_name']);
        $sql->bindValue(':senha', $params['senha']);

        $resultado = $sql->execute();

        if ($resultado == 0) {
            throw new Exception("Falha ao editar usuário");

            return false;
        }
        return true;
    }

    public static function delete($id){
        $con = Connection::getConn();

        $sql = "DELETE FROM users WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if ($resultado == 0) {
            throw new Exception("Falha ao deletar publicação do banco de dados!");

            return false;
        }

        return true;
    }
}