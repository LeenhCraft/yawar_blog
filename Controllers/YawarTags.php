<?php
class YawarTags extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function yawartags()
    {
        parent::otra_clase('Clases', 'CompWeb');
        $this->oClass->linksfooter = false;
        $data['titulo_web'] = "Yawar.:Tags";
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        parent::otro("YawarTag");
        $data['tags'] = $this->other->listarTags();
        if (isset($_SESSION['pe'])) {
            $data['js'] = ['js/tags.js'];
            $data['csrf'] = getTokenCsrf();
        }
        // dep($data,1);
        $this->views->getView('Web/Tag', 'Tags', $data);
    }

    public function save()
    {
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // dep([$_POST, $_FILES]);
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $tag = isset($_POST['newtag']) ? strClean($_POST['newtag']) : '';
                $img = $_FILES['img'];
                $csrf = validarCrf($tk);
                if (!empty($tag)) {
                    if ($csrf['status']) {
                        parent::otra_clase('Clases', 'ImageClass');
                        $validacion = $this->oClass->validarImagen($img);
                        if ($validacion['status']) {
                            parent::otro("YawarTag");
                            $request = $this->other->insertTag($tag, urls_amigables($tag));
                            if ($request['status']) {
                                $nombre = $this->oClass->nombre($img);
                                $extension = $this->oClass->extension($img);
                                $lnh_name = strlen($nombre) > 10 ? 'tag-' . substr($nombre, 0, 5) . '-' . generar_letras(4) : 'tag-' . $nombre . '-' . generar_letras(4);
                                $nomtemp = $lnh_name . '.webp';
                                $ruta_usuario = $img['tmp_name'];
                                $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $nomtemp);
                                if ($conversion) {
                                    // $mini = $this->oClass->minificar($lnh_name . '.webp');
                                    //guardar en la base de datos
                                    $type = "TAG::PORT";
                                    $idgalery = 0;
                                    $img_propietario = $request['text'];
                                    $request_img = $this->other->insertImg($type, $nomtemp, $img_propietario, $idgalery);
                                    if ($request > 0) {
                                        $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'YawarTag creado.' . $request_img);
                                    } else {
                                        $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo guardar la imagen.' . $request_img);
                                    }
                                } else {
                                    $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo convertir la imagen.');
                                }
                            } else {
                                $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo guardar el tag.' . $request['text']);
                            }
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $validacion['text']);
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['text']);
                    }
                } else {

                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'Ingrese el nombre del tag');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
            exit();
        }
    }

    public function updImgTag()
    {
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // dep([$_POST, $_FILES], 1);
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $tag = isset($_POST['_tag']) ? intval($_POST['_tag']) : 0;
                $img = $_FILES['img'];
                $csrf = validarCrf($tk);
                if (!empty($tag)) {
                    if ($csrf['status']) {
                        parent::otra_clase('Clases', 'ImageClass');
                        $validacion = $this->oClass->validarImagen($img);
                        if ($validacion['status']) {
                            parent::otro("YawarTag");
                            $nombre = $this->oClass->nombre($img);
                            $extension = $this->oClass->extension($img);
                            $lnh_name = strlen($nombre) > 10 ? 'tag-' . substr($nombre, 0, 5) . '-' . generar_letras(4) : 'tag-' . $nombre . '-' . generar_letras(4);
                            $nomtemp = $lnh_name . '.webp';
                            $ruta_usuario = $img['tmp_name'];
                            $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $nomtemp);
                            if ($conversion) {
                                // $mini = $this->oClass->minificar($lnh_name . '.webp');
                                //guardar en la base de datos
                                $type = "TAG::PORT";
                                $idgalery = 0;
                                $img_propietario = $tag;
                                $request_img = $this->other->updateImg($nomtemp, $img_propietario, $type);
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
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['text']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'Ingrese el nombre del tag');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
            exit();
        }
    }

    public function updTag()
    {
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // dep([$_POST, $_FILES], 1);
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $idtag = isset($_POST['_tag']) ? intval($_POST['_tag']) : 0;
                $tag = isset($_POST['tagname']) ? strClean($_POST['tagname']) : '';
                $csrf = validarCrf($tk);
                if (!empty($tag) && !empty($idtag)) {
                    if ($csrf['status']) {
                        parent::otro("YawarTag");
                        $request = $this->other->updateTag($tag, urls_amigables($tag), $idtag);
                        if ($request) {
                            $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Tag actualizado.');
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo actualizar el tag.');
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['text']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'Ingrese el nombre del tag');
                }
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
