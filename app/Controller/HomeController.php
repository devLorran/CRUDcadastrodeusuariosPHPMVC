<?php

class HomeController {
    public function index(){
        try {
            $users = User::selecionaTodos();
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $parametros = array();
            $parametros['users'] = $users;

            $conteudo = $template->render($parametros);
            echo $conteudo;
            // var_dump($conteudo);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}