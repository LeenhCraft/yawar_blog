<?php
class Leenh extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['pe']) || !isset($_SESSION['_cf'])) {
            // header('Location: ' . base_url() . 'login');
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
            exit();
        }
    }

    public function leenh()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST" && isset($_SESSION['pe'])) {
            // dep([$_FILES, $_POST], 1);
            $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => 'No cuenta con los permisos necesarios.');
            $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
            $logo = $_FILES['imgLogo'];
            $imgBackWeb = $_FILES['imgBackWeb'];
            $imgBackDes = $_FILES['imgBackDes'];

            $csrf = validarCrf($tk);
            if ($csrf['status']) {
                parent::otra_clase('Clases', 'ImageClass');
                if ($logo['error'] == 0) {
                    $validacion = $this->oClass->validarImagen($logo);
                    if ($validacion['status']) {
                        $nombre = $this->oClass->nombre($logo);
                        $extension = $this->oClass->extension($logo);
                        $lnh_name = strlen($nombre) > 10 ? substr($nombre, 0, 5) . '-' . generar_letras(4) : $nombre . '-' . generar_letras(4);
                        $nomtemp = $lnh_name . '.webp';
                        $ruta_usuario = $logo['tmp_name'];
                        $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $nomtemp);
                        if ($conversion) {
                            // $mini = $this->oClass->minificar($lnh_name . '.webp');
                            //guardar en la base de datos
                            $type = "LOGO::IMG";
                            $idgalery = 0;
                            $img_propietario = 0;
                            $data = $this->model->verLogo($type);
                            if (empty($data)) {
                                $request = $this->model->insertImg($type, $nomtemp, $img_propietario, $idgalery);
                            } else {
                                $request = $this->model->updateImg($data['idimage'], $type, $nomtemp);
                            }
                            if ($request > 0) {
                                $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Logo actualizado correctamente.');
                            } else {
                                $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo guardar la imagen.');
                            }
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo convertir la imagen.');
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $validacion['text']);
                    }
                }

                if ($imgBackWeb['error'] == 0) {
                    $validacion = $this->oClass->validarImagen($imgBackWeb);
                    if ($validacion['status']) {
                        $nombre = $this->oClass->nombre($imgBackWeb);
                        $extension = $this->oClass->extension($imgBackWeb);
                        $lnh_name = strlen($nombre) > 10 ? substr($nombre, 0, 5) . '-' . generar_letras(4) : $nombre . '-' . generar_letras(4);
                        $nomtemp = $lnh_name . '.webp';
                        $ruta_usuario = $imgBackWeb['tmp_name'];
                        $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $lnh_name . '.webp');
                        if ($conversion) {
                            $type = "BACK::WEB";
                            $idgalery = 0;
                            $img_propietario = 0;
                            $data = $this->model->verLogo($type);
                            if (empty($data)) {
                                $request = $this->model->insertImg($type, $nomtemp, $img_propietario, $idgalery);
                            } else {
                                $request = $this->model->updateImg($data['idimage'], $type, $nomtemp);
                            }
                            if ($request > 0) {
                                $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Imagen actualizado correctamente.');
                            } else {
                                $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo guardar la imagen.');
                            }
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo convertir la imagen.');
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $validacion['text']);
                    }
                }
                if ($imgBackDes['error'] == 0) {
                    $validacion = $this->oClass->validarImagen($imgBackDes);
                    if ($validacion['status']) {
                        $nombre = $this->oClass->nombre($imgBackDes);
                        $extension = $this->oClass->extension($imgBackDes);
                        $lnh_name = strlen($nombre) > 10 ? substr($nombre, 0, 5) . '-' . generar_letras(4) : $nombre . '-' . generar_letras(4);
                        $nomtemp = $lnh_name . '.webp';
                        $ruta_usuario = $imgBackDes['tmp_name'];
                        $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $lnh_name . '.webp');
                        if ($conversion) {
                            $type = "BACK::DES";
                            $idgalery = 0;
                            $img_propietario = 0;
                            $data = $this->model->verLogo($type);
                            if (empty($data)) {
                                $request = $this->model->insertImg($type, $nomtemp, $img_propietario, $idgalery);
                            } else {
                                $request = $this->model->updateImg($data['idimage'], $type, $nomtemp);
                            }
                            if ($request > 0) {
                                $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Imagen actualizado correctamente.');
                            } else {
                                $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo guardar la imagen.');
                            }
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo convertir la imagen.');
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $validacion['text']);
                    }
                }
            } else {
                $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Token invalido');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            parent::otro('CompWeb');
            parent::otra_clase('Clases', 'CompWeb');
            $this->oClass->linksfooter = false;
            $data['titulo_web'] = "Account";
            $data['componentes'] = array_merge($this->oClass->principal());
            $data['csrf'] = getTokenCsrf();
            $data['js'] = ['js/publish.js'];
            $data['logo'] = $this->model->verLogo('LOGO::IMG');
            $data['backImg'] = $this->model->verLogo('BACK::WEB');
            $data['backDes'] = $this->model->verLogo('BACK::DES');
            $this->views->getView('Config', 'Index', $data);
        }
    }
}
