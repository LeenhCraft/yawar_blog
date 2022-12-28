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
        $this->oClass->linksfooter = false;
        $data['componentes'] = $this->oClass->compweb(["principal", "body", "register"]);
        // dep($data['componentes'], 1);
        parent::otro('leenh');
        $data['imgBackDes'] = $this->other->verLogo('BACK::DES');
        if ($data['componentes']['register']['status']) {
            $data['csrf'] = getTokenCsrf();
            $data['js'] = ['js/fn_rg_mn.js'];
        }
        $this->views->getView('Web/Index', 'Index', $data);
    }

    public function buscarPosts($parametro = "")
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => '');
            $parametro = strClean($parametro);
            parent::otro("CompWeb");
            // if ($parametro != "" && strlen($parametro) > 2) {
            $parametro = strClean($parametro);
            $json = $this->other->buscarPost($parametro);
            $arrResponse = array('status' => true, 'title' => '', 'icon' => 'success', 'text' => 'Busqueda exitosa', 'data' => $json);
            // }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
        }
    }

    public function dni($parametro)
    {
        // $tiempo_inicial = microtime(true);
        // try {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "GET") {
            $dni = intval(strClean($parametro));
            // set_time_limit(1);
            $response = consultaDNI($dni);
            echo $response;
        }
        // } catch (Exception $th) {
        //     echo "Error: " . $th->getMessage();
        // } finally {
        //     echo "Finalizado";
        // }
        // $tiempo_final = microtime(true);
        // $tiempo = $tiempo_final - $tiempo_inicial;
        // dep($tiempo);
        die();
    }

    public function filiales()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST") {
            $arrData = $this->model->listCombo();
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function registrar()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST") {
            $mensaje = $dniApoderado = $nombreApoderado = $phoneApoderado = '';
            $status = true;
            $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
            $arrResponse = array("status" => false, "text" => $mensaje);
            $dni = isset($_POST['txtdni']) ? intval(strClean($_POST['txtdni'])) : 0;
            $nombre = isset($_POST['txtnom']) ? strClean($_POST['txtnom']) : '';
            $phone = isset($_POST['txtcel']) ? intval(strClean($_POST['txtcel'])) : 0;
            $check = isset($_POST['apoderado']) && strClean($_POST['apoderado']) === 'on' ? true : false;
            $cede = isset($_POST['txtcede']) ? intval(strClean($_POST['txtcede'])) : 0;
            $idapoderado = 0;
            $csrf = validarCrf($tk);
            if ($csrf['status']) {
                if ($check) {
                    $dniApoderado = isset($_POST['txtdniapo']) ? intval(strClean($_POST['txtdniapo'])) : 0;
                    $nombreApoderado = isset($_POST['txtnomapo']) ? strClean($_POST['txtnomapo']) : '';
                    $phoneApoderado = isset($_POST['txtcelapo']) ? intval(strClean($_POST['txtcelapo'])) : 0;
                    if (empty($dniApoderado) || empty($nombreApoderado) || empty($phoneApoderado)) {
                        $mensaje .= "<br>Datos del apoderado incorrectos.";
                        $status = false;
                    } else {
                        parent::otro('YawarMuxus');
                        $idapoderado = $this->other->insertarApoderado($dniApoderado, $nombreApoderado, $phoneApoderado);
                    }
                }
                if (empty($dni) || empty($nombre) || empty($phone) || empty($cede)) {
                    $mensaje .= "<br>Datos del alumno incorrectos.";
                    $status = false;
                }
                // dep([
                //     $mensaje,
                //     $status,
                //     $dni,
                //     $nombre,
                //     $phone,
                //     $check,
                //     $cede,
                //     $dniApoderado,
                //     $nombreApoderado,
                //     $phoneApoderado,
                //     $idapoderado
                // ], 1);
                if (!$status) {
                    die(json_encode(array("status" => false, "text" => $mensaje)));
                }
                parent::otro('YawarMuxus');
                $existe = $this->other->buscar($dni);
                if ($existe['status'] == false) {
                    $respuesta = $this->other->insertar(
                        $nombre,
                        $dni,
                        $phone,
                        $cede,
                        $idapoderado
                    );
                    if ($respuesta) {
                        $arrResponse = array("status" => true, "text" => 'Se Registro correctamente' . $mensaje);
                    } else {
                        $arrResponse = array("status" => false, "text" => "Ocurrio un error al registrarlo." . $mensaje);
                    }
                } else {
                    $arrResponse = array("status" => false, "text" => 'El DNI ingresado ya esta registrado');
                }
            } else {
                $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Token invalido');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function demo()
    {
        dep(date('Y-m-d-H-i-s'));
        dep(path_img_404());
    }
}
