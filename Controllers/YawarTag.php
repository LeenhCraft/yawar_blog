<?php
class YawarTag extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        $url = urls();
        parent::otra_clase('Clases', 'CompWeb');
        $this->oClass->linksfooter = false;
        $data['titulo_web'] = "Yawar.:Tag";
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        $data['tag'] = $this->model->buscarTag($url['method']);
        $data['css'] = ['css/lnh.grid.css'];
        if (!empty($data['tag'])) {
            $data['posts'] = $this->model->post($data['tag']['idtag']);
            $data['img_port'] = $data['tag']['tag_img'];
            if (isset($_SESSION['pe'])) {
                $data['js'] = ['js/tags.js'];
                $data['csrf'] = getTokenCsrf();
            }
            $this->views->getView('Web/Tag', 'Index', $data);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
        }
        exit();
    }
}
