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
        $data['componentes'] = $this->oClass->compweb(["principal", "body"]);
        // dep($data['componentes'], 1);
        $this->views->getView('Web/Index', 'Index', $data);
    }
}
