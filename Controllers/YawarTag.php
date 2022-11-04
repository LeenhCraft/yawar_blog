<?php
class YawarTag extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        $url = urls();
        parent::otra_clase('Clases', 'CompWeb');
        // parent::otro('CompWeb');
        $data['titulo_web'] = "YawarTag";
        $data['componentes'] = $this->oClass->principal();
        $data['tag'] = $this->model->buscarTag($url['method']);
        // dep($data,1);
        if (!empty($data['tag'])) {
            $data['posts'] = $this->model->post($data['tag']['idtag']);
            //     $data['older'] = $this->model->postOlder($data['post']['pos_date'], 1);
            //     $data['next'] = $this->model->postNext($data['post']['pos_date'], 1);
            //     $data['gallery'] = $this->model->postGalleries($data['post']['idpost'], 2);
            //     parent::otro('Web');
            // $this->other->masVisitado($_SESSION['vi'], $data['post']['idpost'], $url['method']);
            // dep($data, 1);
            $this->views->getView('Web/Tag', 'Index', $data);
        } else {
            dep('404');
        }
        // if (method_exists($this, $url['method'])) {
        //     echo 'Method exists';
        //     $this->{$url['method']}();
        // }
        exit();
    }
}
