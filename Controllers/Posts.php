<?php
class Posts extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }
    public function Posts()
    {
        $data['css'] = ['css/lnh.grid.css'];
        parent::otra_clase('Clases', 'CompWeb');
        $this->oClass->linksfooter = false;
        $data['titulo_web'] = "Yawar.:Posts";
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        parent::otro('CompWeb');
        $data['posts'] = $this->other->posts(2, 0, 9);
        $this->views->getView('Web/Post', 'ListaPosts', $data);
    }

    public function pagina($param)
    {
        dep($_SESSION);
        $and = isset($_SESSION['_cf']) && $_SESSION['_cf'] === 'ok' ? "a.pos_publicar = 0" : "a.pos_publicar = 1";
        dep($and);
    }
}
