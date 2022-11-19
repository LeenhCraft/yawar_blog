<?php
class Web extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function web()
    {
        parent::otra_clase('Clases', 'CompWeb');
        $data['titulo_web'] = "Blog";
        $this->oClass->linksfooter = false;
        $data['componentes'] = $this->oClass->compweb(["principal", "body"]);
        // dep($data['componentes'], 1);
        parent::otro('leenh');
        $data['imgBackDes'] = $this->other->verLogo('BACK::DES');
        $this->views->getView('Web/Index', 'Index', $data);
    }

    public function buscarPosts($parametro = "")
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => '');
            $parametro = strClean($parametro);
            parent::otro("CompWeb");
            // if ($parametro != "" && strlen($parametro) > 2) {
            $parametro = strClean($parametro);
            $json = $this->other->buscarPost($parametro);
            $arrResponse = array('status' => true, 'title' => '', 'icon' => 'success', 'text' => 'Busqueda exitosa', 'data' => $json);
            // }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
        }
    }
}
