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
            $data['css'] = ['css/lnh.grid.css'];
            parent::otro("leenh");
            $data['logo'] = $this->other->verLogo('LOGO::IMG');
            $data['backImg'] = $this->other->verLogo('BACK::WEB');
            $data['backDes'] = $this->other->verLogo('BACK::DES');
            $data['imgSignin'] = $this->other->verLogo('SIGNIN::PORT');
            $data['imgSignup'] = $this->other->verLogo('SIGNUP::PORT');
            $data['secRegister'] = $this->other->verLogo('INDEX::CONT');
            // dep($data,1);
            if (!empty($data['user']['usu_foto'])) {
                $data['img_port'] = img_user() . $data['user']['usu_foto'];
            }
            if (isset($_SESSION['pe'])) {
                array_push($data['js'], 'js/acc.js');
                $data['csrf'] = getTokenCsrf();
            }
            if (isset($_SESSION['lnh']) && $_SESSION['lnh'] === '1') {
                array_push($data['js'], 'js/c.js');
            }
            $this->views->getView('Web/Login', 'Account', $data);
        }
    }
    public function updImgAcc()
    {
        // dep($_POST);
        // dep($_FILES, 1);
        if (isset($_SESSION['pe'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // dep([$_POST, $_FILES], 1);
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $idwebusuario = isset($_POST['_usr']) ? intval($_POST['_usr']) : 0;
                // $nombre = isset($_POST['name']) ? strClean($_POST['name']) : '';
                $img = $_FILES['img'];
                $csrf = validarCrf($tk);
                // if (!empty($tag)) {
                if ($csrf['status']) {
                    parent::otra_clase('Clases', 'ImageClass');
                    $validacion = $this->oClass->validarImagen($img);
                    if ($validacion['status']) {
                        $nombre = $this->oClass->nombre($img);
                        $extension = $this->oClass->extension($img);
                        $lnh_name = strlen($nombre) > 10 ? 'usu-' . substr($nombre, 0, 5) . '-' . generar_letras(4) : 'usu-' . $nombre . '-' . generar_letras(4);
                        $nomtemp = urls_amigables($lnh_name) . '.webp';
                        $ruta_usuario = $img['tmp_name'];
                        // $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $nomtemp);
                        // $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/' . img_user() . $nomtemp);
                        $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, dir_recursos() . img_user() . $nomtemp);
                        if ($conversion) {
                            // $mini = $this->oClass->minificar($lnh_name . '.webp');
                            //guardar en la base de datos
                            $type = "USER::PORT";
                            $idgalery = 0;
                            $img_propietario = $idwebusuario;
                            $request_img = $this->model->updImgPerfil($nomtemp, $img_propietario, $type);
                            if ($request_img) {
                                $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Imagen actualizada.');
                            } else {
                                $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo guardar la imagen.');
                            }
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo convertir la imagen.');
                        }
                    }
                } else {
                    $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['message']);
                }
                // } else {
                //     $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'Ingrese el nombre del tag');
                // }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
            exit();
        }
    }
}
