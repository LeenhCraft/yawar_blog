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
        $params = explode(",", $url['params']);
        $limite = 6;
        if ($params[0] === "pagina") {
            $pagina = empty($params[1]) || !is_numeric($params[1]) ? 1 : $params[1];
            $offset = ($pagina - 1) *  $limite;
        } else {
            $pagina = 1;
        }
        // dep($params, 1);
        $data['gallery'] = $this->model->buscarGallery($url['method']);
        if (!empty($data['gallery'])) {
            $offset = ($pagina - 1) *  $limite;
            $data['url'] = path_gallery() . $url['method'] . '/pagina/';
            $data['limite'] = $limite;
            $data['offset'] = $offset;
            $data['pagina'] = $pagina;
            $data['images'] = $this->model->images($data['gallery']['idgalery'], $offset, $limite);
            $data['count'] = $this->model->countImages($data['gallery']['idgalery']);
            $data['img_port'] = $data['gallery']['ga_img_port'];
            $data['post'] = $this->model->postAsociados($data['gallery']['idgalery']);
            if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
                $data['js'] = ['js/gallery.js'];
                $data['csrf'] = getTokenCsrf();
                $data['css'] = ['css/lnh.grid.css'];
            }
            // dep($data, 1);
            $this->views->getView('Web/Gallery', 'Index', $data);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
        }
        exit();
    }
}
