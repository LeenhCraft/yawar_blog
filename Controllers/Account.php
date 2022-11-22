<?php
class Account extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['pe'])) {
            header('Location: ' . base_url() . 'Signin');
            exit();
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
            $this->oClass->linksfooter = false;
            $data['titulo_web'] = "Account";
            $data['componentes'] = array_merge($this->oClass->principal());
            $data['posts'] = $this->other->posts(2, 0, 5);
            $data['postsusuario'] = $this->other->posts(3, 0, 5);
            // dep($data['postsusuario'],1);
            parent::otro('web');
            $data['user'] = $this->other->getUser($_SESSION['lnh']);
            $data['csrf'] = getTokenCsrf();
            $data['js'] = ['js/publish.js'];
            parent::otro("leenh");
            $data['logo'] = $this->other->verLogo('LOGO::IMG');
            $data['backImg'] = $this->other->verLogo('BACK::WEB');
            $data['backDes'] = $this->other->verLogo('BACK::DES');
            $this->views->getView('Web/Login', 'Account', $data);
        }
    }
}
