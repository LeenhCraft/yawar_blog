<?php
class YawarGalleries extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function yawargalleries()
    {
        parent::otra_clase('Clases', 'CompWeb');
        $this->oClass->linksfooter = false;
        $data['titulo_web'] = "Yawar.:Tags";
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        parent::otro("YawarGallery");
        $data['galleries'] = $this->other->listarGalleries();
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $data['js'] = ['js/gallery.js'];
            $data['csrf'] = getTokenCsrf();
            $data['css'] = ['css/lnh.grid.css'];
        }
        // dep($data,1);
        $this->views->getView('Web/Gallery', 'Galleries', $data);
    }

    public function save()
    {
        // dep($_POST);
        // dep($_SESSION['csrf'], 1);
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // dep([$_POST, $_FILES], 1);
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $gallery = isset($_POST['newgal']) ? strClean($_POST['newgal']) : '';
                $img = $_FILES['img'];
                $csrf = validarCrf($tk);
                if (!empty($gallery)) {
                    if ($csrf['status']) {
                        parent::otra_clase('Clases', 'ImageClass');
                        $validacion = $this->oClass->validarImagen($img);
                        if ($validacion['status']) {
                            parent::otro("YawarGallery");
                            $request = $this->other->insertGal($gallery, urls_amigables($gallery));
                            if ($request['status']) {
                                $nombre = $this->oClass->nombre($img);
                                $extension = $this->oClass->extension($img);
                                $carpeta = date('Y-m-d-H-i-s') . '-';
                                $lnh_name = strlen($nombre) > 10 ? 'gal-' . substr($nombre, 0, 5) . '-' . generar_letras(4) : 'gal-' . $nombre . '-' . generar_letras(4);
                                $nomtemp = urls_amigables($carpeta . $lnh_name) . '.webp';
                                $ruta_usuario = $img['tmp_name'];
                                // $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $nomtemp);
                                $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, dir_recursos() . img_gallery() . $nomtemp);
                                if ($conversion) {
                                    // $mini = $this->oClass->minificar($lnh_name . '.webp');
                                    //guardar en la base de datos
                                    $type = "GALLERY::PORT";
                                    $idgalery = 0;
                                    $img_propietario = $request['text'];
                                    parent::otro("ImageClass");
                                    $request_img = $this->other->insertImg($type, $nomtemp, $img_propietario, $idgalery);
                                    if ($request > 0) {
                                        $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Galeria creado.' . $request_img);
                                    } else {
                                        $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo guardar la imagen.' . $request_img);
                                    }
                                } else {
                                    $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo convertir la imagen.');
                                }
                            } else {
                                $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo guardar la galeria.' . $request['text']);
                            }
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $validacion['text']);
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['text']);
                    }
                } else {

                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'Ingrese el nombre dela galeria.');
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
                dep([$_POST, $_FILES], 1);
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
                            $carpeta = date('Y-m-d-H-i-s') . '-';
                            $lnh_name = strlen($nombre) > 10 ? 'tag-' . substr($nombre, 0, 5) . '-' . generar_letras(4) : 'tag-' . $nombre . '-' . generar_letras(4);
                            $nomtemp = $carpeta . $lnh_name . '.webp';
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

    public function updGal()
    {
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // dep($_POST, 1);
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $idgalery = isset($_POST['_gal']) ? intval($_POST['_gal']) : 0;
                $gallery = isset($_POST['galname']) ? strClean($_POST['galname']) : '';
                $publicar = isset($_POST['publicar']) && strClean($_POST['publicar']) === 'on' ? 1 : 0;
                $status = isset($_POST['status']) && strClean($_POST['status']) === 'on' ? 1 : 0;
                $csrf = validarCrf($tk);
                if (!empty($gallery) && !empty($idgalery)) {
                    if ($csrf['status']) {
                        parent::otro("YawarGallery");
                        $request = $this->other->updateGal($gallery, urls_amigables($gallery), $idgalery, $publicar, $status);
                        if ($request) {
                            $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Galeria actualizado.');
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo actualizar la galeria.');
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['message']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'Ingrese el nombre de la galeria');
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

    public function image()
    {
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // dep([$_POST, $_FILES], 1);
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $tag = isset($_POST['_gal']) ? intval($_POST['_gal']) : 0;
                $img = $_FILES['img'];
                $csrf = validarCrf($tk);
                if (!empty($tag)) {
                    if ($csrf['status']) {
                        parent::otra_clase('Clases', 'ImageClass');
                        $validacion = $this->oClass->validarImagen($img);
                        if ($validacion['status']) {
                            parent::otro("YawarGallery");
                            $nombre = $this->oClass->nombre($img);
                            $extension = $this->oClass->extension($img);
                            $carpeta = date('Y-m-d.H.i.s') . '-';
                            $lnh_name = strlen($nombre) > 10 ? '-' . substr($nombre, 0, 5) . '-' . generar_letras(4) : '-' . $nombre . '-' . generar_letras(4);
                            $nomtemp = urls_amigables($carpeta . $lnh_name) . '.webp';
                            $ruta_usuario = $img['tmp_name'];
                            $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, dir_recursos() . img_gallery() . $nomtemp);
                            if ($conversion) {
                                // $mini = $this->oClass->minificar($lnh_name . '.webp');
                                //guardar en la base de datos
                                $type = "GALLERY::PORT";
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
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['message']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'Ingrese el nombre dela galeria.');
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

    public function assoPost()
    {
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // dep($_POST, 1);
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $idgalery = isset($_POST['_gal']) ? intval($_POST['_gal']) : 0;
                $post = isset($_POST['post']) ? intval($_POST['post']) : 0;
                $csrf = validarCrf($tk);
                if (!empty($post) && !empty($idgalery)) {
                    if ($csrf['status']) {
                        parent::otro("YawarGallery");
                        $request = $this->other->updPostAso($post, $idgalery);
                        if ($request) {
                            $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Post asociado a la galeria.');
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo asociar el post a la galeria.');
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['message']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'No deje campos vacios');
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

    public function addImgGal()
    {
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $idgalery = isset($_POST['_gal']) ? intval($_POST['_gal']) : 0;
                $img = $_FILES['img'];
                $arrImg = [];
                $count = count($img['name']);
                foreach ($img as $key => $value) {
                    for ($i = 0; $i < $count; $i++) {
                        $arrImg[$i][$key] = $value[$i];
                    }
                }
                $csrf = validarCrf($tk);
                if (!empty($idgalery)) {
                    if ($csrf['status']) {
                        $text = "";
                        parent::otra_clase('Clases', 'ImageClass');
                        parent::otro("YawarGallery");
                        foreach ($arrImg as $key => $img) {
                            // dep([$key, $value]);
                            $validacion = $this->oClass->validarImagen($img);
                            if ($validacion['status']) {
                                $nombre = $this->oClass->nombre($img);
                                $extension = $this->oClass->extension($img);
                                $carpeta = date('Y-m-d-H-i-s') . '-';
                                $lnh_name = strlen($nombre) > 10 ? 'gal-' . $idgalery . '-' . substr($nombre, 0, 5) . '-' . generar_letras(4) : 'gal-' . $idgalery . '-' . $nombre . '-' . generar_letras(4);
                                $nomtemp = $carpeta . $lnh_name . '.webp';
                                $ruta_usuario = $img['tmp_name'];
                                // $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $nomtemp);
                                $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, dir_recursos() . img_gallery() . $nomtemp);
                                $request = $this->other->insImgGal("GALLERY::CONT", $nomtemp, $idgalery, $idgalery);
                                if ($request) {
                                    $text .= "Imagen agregada correctamente ";
                                } else {
                                    $text .= "No se puedo registrar la imagen " . $lnh_name . " en la galeria " . $idgalery . ". ";
                                }
                            } else {
                                $text .= "No se pudo subir la imagen " . $key . " por el siguiente error: " . $validacion['text'] . ' ';
                            }
                        }
                        $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => $text);
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['message']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'No deje campos vacios');
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

    public function delImgGal()
    {
        // dep($_POST,1);
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $idimage = isset($_POST['a']) ? intval($_POST['a']) : 0;
                $idgalery = isset($_POST['b']) ? intval($_POST['b']) : 0;
                $csrf = validarCrf($tk);
                if (!empty($idgalery) && !empty($idimage)) {
                    if ($csrf['status']) {
                        parent::otro("YawarGallery");
                        $request = $this->other->delImgGal($idimage, $idgalery);
                        if ($request) {
                            $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Imagen eliminada de la galeria.');
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo eliminar la imagen de la galeria.');
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['message']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'No deje campos vacios');
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

    public function delPostAso()
    {
        // dep($_POST, 1);
        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Ingrese los datos correctamente');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
                $idgalery = isset($_POST['_gal']) ? intval($_POST['_gal']) : 0;
                $post = isset($_POST['post']) ? intval($_POST['post']) : 0;
                $csrf = validarCrf($tk);
                if (!empty($idgalery) && !empty($post)) {
                    if ($csrf['status']) {
                        parent::otro("YawarGallery");
                        $request = $this->other->delPostAso($idgalery, $post);
                        if ($request) {
                            $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Excelente!!', "text" => 'Post eliminado de la galeria.');
                        } else {
                            $arrResponse = array("status" => false, 'icon' => 'error', 'title' => 'Error!!', "text" => 'No se pudo eliminar el post de la galeria.');
                        }
                    } else {
                        $arrResponse = array("status" => false, 'icon' => 'info', 'title' => 'Atención!!', "text" => $csrf['message']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'title' => 'Atención!!', 'icon' => 'warning', 'text' => 'No deje campos vacios');
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
