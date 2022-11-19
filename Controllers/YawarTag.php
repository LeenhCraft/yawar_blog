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
        if (!empty($data['tag'])) {
            $data['posts'] = $this->model->post($data['tag']['idtag']);
            $data['img_port'] = $data['tag']['tag_img'];
            $this->views->getView('Web/Tag', 'Index', $data);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
        }
        exit();
    }
}
