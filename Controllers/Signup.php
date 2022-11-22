<?php
class Signup extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['pe'])) {
            if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST") {
                $this->register();
            } else {
                $data['csrf'] = getTokenCsrf();
                parent::otro("Leenh");
                $data['logo'] = $this->other->verLogo('LOGO::IMG');
                $this->views->getView('Web/Login', 'Signup', $data);
            }
        } else {
            $url = urls();
            if ($url['method'] == 'confirmar') {
                // $this->views->getView('Web/Login', 'ConfirSignup');
                $this->confirmar($url['params']);
            } else {
                header('Location: ' . base_url() . 'account');
            }
        }
        exit();
    }

    public function register()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST") {
            $nombre = (isset($_POST['txtnombre']) && !empty($_POST['txtnombre'])) ? strClean($_POST['txtnombre']) : '';
            $email = (isset($_POST['txtemail']) && !empty($_POST['txtemail'])) ? strClean($_POST['txtemail']) : '';
            $pass = (isset($_POST['txtpass']) && !empty($_POST['txtpass'])) ? strClean($_POST['txtpass']) : '';
            $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
            if (empty($nombre) || empty($email) || empty($pass)) {
                $arrResponse = array("status" => false, 'icon' => 'warning', 'title' => 'Atención!!', "text" => 'Los campos con * son obligatorios.');
            } else {
                $csrf = validarCrf($tk);
                if ($csrf['status']) {
                    parent::otra_clase('Clases', 'SignupExtends');
                    $arrResponse = $this->oClass->registrar_usuario(null, null, $nombre, $email, $pass, '');
                } else {
                    $arrResponse = array("status" => false, 'icon' => 'warning', 'title' => 'Atención!!', "text" => 'Token de seguridad no válido.');
                }
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function confirmar($parametro)
    {
        if (empty($parametro)) {
            header('Location: ' . base_url());
        } else {
            $arrParams = explode(',', $parametro);
            $strEmail = strClean($arrParams[0]);
            $strToken = strClean($arrParams[1]);
            // dep([$strEmail, $strToken], 1);
            parent::otro('web');
            $response = $this->other->validar($strEmail, $strToken);
            if ($response['status']) {
                $text = '<span  class="text-success">Su cuenta ha sido <b>activada</b>, por favor inicie sesion para continuar.</span><div class="container mt-4"></div>';
            } else {
                $text = '<span  class="text-danger">Su cuenta <b>no pudo ser activada</b>, por favor intente nuevamente.</span><div class="container mt-4"></div>';
            }
            parent::otro('Tienda');
            $data['titulo_web'] = 'Achuu Online';
            $data['empresa'] = $this->other->empresa();
            $data['text'] = $text;
            $this->views->getView('Web/Login', 'ConfirSignup', $data);
        }
        exit();
    }
}
