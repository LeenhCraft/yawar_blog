<?php
class Account extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['pe'])) {
            header('Location: ' . base_url());
        }
    }

    public function account()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST" && isset($_SESSION['pe'])) {
            // $order = isset($_POST['order']) ? intval($_POST['order']) : 0;
            parent::otra_clase('Clases', 'web_eco');
            $data = $this->oClass->saveme();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            parent::otro('CompWeb');
            parent::otra_clase('Clases', 'CompWeb');
            $data['titulo_web'] = "Account";
            $data['componentes'] = array_merge($this->oClass->principal());
            $data['posts'] = $this->other->posts(2, 0, 5);
            $data['postsusuario'] = $this->other->posts(3, 0, 5);
            // dep($data['postsusuario'],1);
            parent::otro('web');
            $data['user'] = $this->other->getUser($_SESSION['lnh']);
            $this->views->getView('Web/Login', 'Account', $data);
        }
    }
}
