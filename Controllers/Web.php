<?php
class Web extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function web()
    {
        $data['titulo_web'] = "Blog";
        $this->views->getView('Web', 'index2', $data);
    }
}
