<?php
class YawarGallery extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        $url = urls();
        parent::otra_clase('Clases', 'CompWeb');

        $data['titulo_web'] = "Gallery";
        $data['componentes'] = $this->oClass->principal();
        $data['gallery'] = $this->model->buscarGallery($url['method']);
        if (!empty($data['gallery'])) {
            $data['images'] = $this->model->images($data['gallery']['idgalery']);
            $data['img_port'] = $data['gallery']['ga_img_port'];
            $data['post'] = $this->model->postAsociados($data['gallery']['idgalery']);
            // dep($data, 1);
            $this->views->getView('Web/Gallery', 'Index', $data);
        } else {
            dep('404');
        }
        exit();
    }
}
