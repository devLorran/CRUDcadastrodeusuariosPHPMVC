<?php

class Core {
    public function start($urlGet){
        //chamando todos os metodos na URL e lendo o valor passado nele Exemplo: ?pagina=home&metodo=create
        if (isset($urlGet['metodo'])) {
            $acao = $urlGet['metodo'];
        } else {
            $acao = 'index';
        }
        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'].'Controller');
        } else {
            $controller = 'HomeController';
        }
        if (!class_exists($controller)) {
            $controller = "ErroController";
        }
        // echo $controller;
        // echo $controller;
        if (isset($urlGet['id']) && $urlGet['id'] != null) {
            $id = $urlGet['id'];
        }
        else {
            $id = null;
        }
        //call_user_func_array(array(new $controller, $acao), array());
        call_user_func_array(array(new $controller, $acao), array('id' => $id));
    }
}