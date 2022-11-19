<?php
class Publicar extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['pe'])) {
            // header('Location: ' . base_url());
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notAccess();
            exit();
        }
    }

    public function publicar()
    {
        parent::otra_clase('Clases', 'CompWeb');
        $this->oClass->linksfooter = false;
        $data['titulo_web'] = "Publicar";
        $this->oClass->esloganfooter = false;
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        // dep($_SESSION, 1);
        $this->views->getView('Web/Publicar', 'Index', $data);
    }
}
