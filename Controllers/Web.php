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
        $data['componentes'] = $this->oClass->components();
        // dep($this->oClass->components(), 1);
        $this->views->getView('Web/Index', 'Index', $data);
    }
}
