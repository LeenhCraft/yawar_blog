<?php
class Publicar extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['pe'])) {
            header('Location: ' . base_url());
        }
    }
    public function publicar()
    {
        parent::otra_clase('Clases', 'CompWeb');
        $data['titulo_web'] = "Publicar";
        $this->oClass->esloganfooter = false;
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        // dep($_SESSION, 1);
        $this->views->getView('Web/Publicar', 'Index', $data);
    }
}
