<?php
class YawarGallery extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        $url = urls();
        parent::otra_clase('Clases', 'CompWeb');
        $this->oClass->linksfooter = false;
        $data['titulo_web'] = "Yawar.:Gallery";
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        $data['gallery'] = $this->model->buscarGallery($url['method']);
        if (!empty($data['gallery'])) {
            $data['images'] = $this->model->images($data['gallery']['idgalery']);
            $data['img_port'] = $data['gallery']['ga_img_port'];
            $data['post'] = $this->model->postAsociados($data['gallery']['idgalery']);
            if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
                $data['js'] = ['js/gallery.js'];
                $data['csrf'] = getTokenCsrf();
                $data['css'] = ['css/lnh.grid.css'];
            }
            // dep($data,1);
            $this->views->getView('Web/Gallery', 'Index', $data);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
        }
        exit();
    }
}
