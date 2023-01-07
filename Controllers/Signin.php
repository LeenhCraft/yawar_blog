<?php
class Signin extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['pe'])) {
            if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST") {
                $this->session();
            } else {
                $data['csrf'] = getTokenCsrf();
                parent::otro("Leenh");
                $img = $this->other->verLogo('LOGO::IMG');
                $data['logo'] = !empty($img) ? img_logo() . $img['img_url'] : img_404();
                $img = $this->other->verLogo('SIGNIN::PORT');
                $data['imgSignin'] = !empty($img) ? img_other() . $img['img_url'] : img_404();
                $this->views->getView('Web/Login', 'Signin', $data);
            }
        } else {
            header('Location: ' . base_url() . 'account');
        }
        exit();
    }

    public function session()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST") {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'No deje campos vacios');
            $usuario = isset($_POST['txtusuario']) ? strClean($_POST['txtusuario']) : '';
            $pass = isset($_POST['txtpass']) ? strClean($_POST['txtpass']) : '';
            $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
            if (empty($usuario) || empty($pass)) {
                echo json_encode(array('status' => false, 'icon' => "warning", 'text' => 'Ingrese usuario y contraseña'));
                die();
            } else {
                $csrf = validarCrf($tk);
                if ($csrf['status']) {
                    parent::otro('web');
                    $data = $this->other->login($usuario);
                    if (empty($data)) {
                        $arrResponse = array('status' => false, 'title' => 'Atención!', 'icon' => 'warning', 'text' => 'El usuario es invalido, por favor vuelva a intentarlo');
                    } else {
                        if (password_verify($pass, $data['usu_pass'])) {
                            if ($data['usu_activo'] == 1 && $data['usu_estado'] == 1) {
                                $this->other->upd_visita($data['idwebusuario']);
                                $this->other->upd_centinela($data['idwebusuario']);
                                $_SESSION['lnh'] = $data['idwebusuario'];
                                if ($data['idwebusuario'] == 1) {
                                    $_SESSION['_cf'] = "ok";
                                }
                                $_SESSION['pe'] = true;
                                $arrResponse = array('status' => true, 'title' => 'Excelente!!', 'icon' => 'success', 'text' => 'Bienvenido ' . $data['usu_nombre']);
                            } else if ($data['usu_cuenta'] == 0) {
                                $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'No tiene cuenta');
                            } else if ($data['usu_activo'] == 0 && $data['usu_estado'] == 1) {
                                $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Usuario sin confirmar, revise su email para confirmar su cuenta. O comuniquece con el administrador para acceder a su cuenta');
                            } else {
                                $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Usuario bloqueado');
                            }
                        } else {
                            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Contraseña incorrecta');
                        }
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Token invalido');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
