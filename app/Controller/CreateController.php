<?php

class CreateController {
    public function index(){
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('#');

        $parametros = array();

        $conteudo = $template->render($parametros);

        echo $conteudo;
    }

    public function create(){
        $loader = new \Twig\loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();

        $conteudo = $template->render($parametros);

        echo $conteudo;
    }
    public function insert(){
        try {
            User::insert($_POST);

            echo '<script> alert("usuário inserido com sucesso!") </script>';
            echo '<script> location.href="http://localhost/crudcadastrodeusuarios/" </script>';
        } catch (Exception $e) {
            echo '<script> alert("'.$e->getMessage().'") </script>';
        }
    }

    public function change($paramId){
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $post = User::selecionarPorId($paramId);
        // var_dump($post);
        $parametros = array();

        $parametros['id'] = $post->id;
        $parametros['nome'] = $post->nome;
        $parametros['user_name'] = $post->user_name;
        $parametros['senha'] = $post->senha;
        $conteudo = $template->render($parametros);

        echo $conteudo;
    }

    public function update(){
        // var_dump($_POST);
        try {
            User::update($_POST);
            echo '<script> alert("usuário editado com sucesso!") </script>';
            echo '<script> location.href="http://localhost/crudcadastrodeusuarios/" </script>';
        } catch (Exception $e) {
            echo '<script> alert("'.$e->getMessage().'") </script>';
            echo '<script> location.href="http://localhost/crudcadastrodeusuarios/?pagina=create&metodo=change&id='.$_POST['id'].'" </script>';
        }
    }

    public function delete($paramId){
        try {
            User::delete($paramId);
            echo '<script> alert("usuário deletado com sucesso!") </script>';
            echo '<script> location.href="http://localhost/crudcadastrodeusuarios/" </script>';
        } catch (Exception $e) {
            echo '<script> alert("'.$e->getMessage().'") </script>';
            echo '<script> location.href="http://localhost/crudcadastrodeusuarios/" </script>';
        }
    }
}
