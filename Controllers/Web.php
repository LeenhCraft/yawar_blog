<?php
class Web extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function web()
    {
        $this->views->getView('Web', 'web');
    }
}
