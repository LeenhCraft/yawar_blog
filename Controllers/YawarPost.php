<?php
class YawarPost extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        $url = urls();
        parent::otra_clase('Clases', 'CompWeb');
        parent::otro('CompWeb');
        $data['titulo_web'] = "Yawar.:Post";
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        $data['post'] = $this->model->buscarPost($url['method']);
        if (!empty($data['post'])) {
            $data['postrandom'] = $this->other->randoPost(3);
            $data['older'] = $this->model->postOlder($data['post']['pos_date'], 1);
            $data['next'] = $this->model->postNext($data['post']['pos_date'], 1);
            $data['gallery'] = $this->model->postGalleries($data['post']['idpost'], 2);
            parent::otro('Web');
            $this->other->masVisitado($_SESSION['vi'], $data['post']['idpost'], $url['method']);
            // dep($data, 1);
            $this->views->getView('Web/Post', 'Index', $data);
        } else {
            require_once __DIR__ .'/Error.php';
        }
        // if (method_exists($this, $url['method'])) {
        //     echo 'Method exists';
        //     $this->{$url['method']}();
        // }
        exit();
    }
}
