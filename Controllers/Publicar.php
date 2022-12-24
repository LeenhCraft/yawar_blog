<?php
class Publicar extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['pe'])) {
            // header('Location: ' . base_url());
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notAccess();
            exit();
        }
    }

    public function publicar()
    {
        parent::otra_clase('Clases', 'CompWeb');
        $this->oClass->linksfooter = false;
        $data['titulo_web'] = "Publicar";
        $this->oClass->esloganfooter = false;
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        parent::otro("YawarTag");
        $data['tags'] = $this->other->listarTags();
        $data['gallery'] = $this->model->listarGalleries();
        $data['csrf'] = getTokenCsrf();
        //documentacion de la libreria
        /*
        https://www.jqueryscript.net/form/tags-selector-tagselect.html#google_vignette
        */
        $data['js'] = ['js/jquery.tagselect.js', 'js/lnh.tagselect.js'];
        $data['css'] = ['css/jquery.tagselect.css', 'css/lnh.grid.css', 'css/create.post.css'];
        $this->views->getView('Web/Publicar', 'Index', $data);
    }

    public function crear()
    {
        // dep($_POST);
        // dep($_FILES, 1);
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST") {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'No deje campos vacios');

            $titulo = isset($_POST['titulo']) ? strClean($_POST['titulo']) : '';
            $resumen = isset($_POST['resumen']) ? strClean($_POST['resumen']) : '';
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            $gallery = isset($_POST['gallery']) ? strClean($_POST['gallery']) : '';
            $contenido = isset($_POST['contenido']) ? strClean($_POST['contenido']) : '';
            $idwebusuario = $_SESSION['lnh'];
            $publicar = isset($_POST['publicar']) && strClean($_POST['publicar']) === 'on' ? 1 : 0;
            $principal = isset($_POST['principal']) && strClean($_POST['principal']) === 'on' ? 1 : 0;
            $img = isset($_FILES['portada']) ? $_FILES['portada'] : '';
            $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
            // dep($principal, 1);

            $csrf = validarCrf($tk);
            if ($csrf['status']) {
                if (empty($titulo) || empty($contenido) || empty($img) || empty($tags)) {
                    $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'No deje campos vacios.');
                } else {
                    $slug = strlen($titulo) > 30 ? substr($titulo, 0, 30) : $titulo;
                    $slug = urls_amigables($slug);
                    //inseratr en bd
                    $respuesta = $this->model->crearPost($idwebusuario, 0, $principal, $titulo, $slug, $resumen, $contenido, $publicar, 1);

                    if ($respuesta['status']) {
                        $requestGallery = $this->model->galleryPost($respuesta['text'], $gallery);
                        if (!empty($tags)) {
                            foreach ($tags as $slugTag) {
                                $requestTags = $this->model->tagsPost($respuesta['text'], $slugTag);
                            }
                        }
                        if ($publicar) {
                            $requestPrincipal = $this->model->principalPost($respuesta['text']);
                        }
                        parent::otra_clase('Clases', 'ImageClass');
                        $validacion = $this->oClass->validarImagen($img);
                        if ($validacion['status']) {
                            $nombre = $this->oClass->nombre($img);
                            $extension = $this->oClass->extension($img);
                            // $lnh_name = strlen($nombre) > 10 ? substr($nombre, 0, 5) . '-' . generar_letras(4) : $nombre . '-' . generar_letras(4);
                            $lnh_name = strlen($titulo) > 30 ? substr($titulo, 0, 30) : $titulo;
                            $nomtemp = $lnh_name . '.webp';
                            $ruta_usuario = $img['tmp_name'];
                            $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $nomtemp);
                            if ($conversion) {
                                // $mini = $this->oClass->minificar($lnh_name . '.webp');
                                //guardar en la base de datos
                                $type = "POST::PORT";
                                $idgalery = 0;
                                $img_propietario = $respuesta['text'];
                                $request = $this->model->insertImg($type, $nomtemp, $img_propietario, $idgalery);
                                if ($request > 0) {
                                    $textImg = 'Imagen cargada correctamente.';
                                } else {
                                    $textImg = 'No se pudo guardar la imagen.';
                                }
                            } else {
                                $textImg = 'No se pudo convertir la imagen.';
                            }
                        } else {
                            $textImg = $validacion['text'];
                        }
                        if ($respuesta['status']) {
                            $arrResponse = array('status' => true, 'url' => $slug, 'text' => 'Post creado correctamente. ' . $textImg);
                        }
                    } else {
                        $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'No se pudo crear el post. ' . $respuesta['text']);
                    }
                }
            } else {
                $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Token invalido');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function actualizar()
    {
        // dep($_POST);
        // dep($_FILES, 1);
        if (strtoupper($_SERVER['REQUEST_METHOD']) === "POST") {
            $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'No deje campos vacios');

            $titulo = isset($_POST['titulo']) ? strClean($_POST['titulo']) : '';
            $resumen = isset($_POST['resumen']) ? strClean($_POST['resumen']) : '';
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            $gallery = isset($_POST['gallery']) ? strClean($_POST['gallery']) : '';
            $contenido = isset($_POST['contenido']) ? strClean($_POST['contenido']) : '';
            $idwebusuario = $_SESSION['lnh'];
            $publicar = isset($_POST['publicar']) && strClean($_POST['publicar']) === 'on' ? 1 : 0;
            $pos_status = isset($_POST['status']) && strClean($_POST['status']) === 'on' ? 1 : 0;
            $principal = isset($_POST['principal']) && strClean($_POST['principal']) === 'on' ? 1 : 0;
            $img = isset($_FILES['portada']) ? $_FILES['portada'] : '';
            $tk = isset($_POST['_token']) ? strClean($_POST['_token']) : '';
            $idpost = isset($_POST['_edit']) ? intval($_POST['_edit']) : 0;
            // dep($principal, 1);

            $csrf = validarCrf($tk);
            if ($csrf['status']) {
                if (empty($idpost) || empty($titulo) || empty($contenido) || empty($tags)) {
                    $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'No deje campos vacios.');
                } else {
                    $slug = strlen($titulo) > 30 ? urls_amigables(substr($titulo, 0, 30)) : urls_amigables($titulo);
                    //inseratr en bd
                    $respuesta = $this->model->actualizarPost($idpost, $idwebusuario, 0, $principal, $titulo, $slug, $resumen, $contenido, $publicar, $pos_status);

                    if ($respuesta['status']) {
                        $requestGallery = $this->model->updateGalleryPost($idpost, $gallery);
                        if (!empty($tags)) {
                            foreach ($tags as $slugTag) {
                                $requestTags = $this->model->updateTagsPost($idpost, $slugTag);
                            }
                        }
                        if ($publicar) {
                            $requestPrincipal = $this->model->principalPost($idpost);
                        }
                        parent::otra_clase('Clases', 'ImageClass');
                        $validacion = $this->oClass->validarImagen($img);
                        $textImg = '';
                        if ($validacion['status']) {
                            $nombre = $this->oClass->nombre($img);
                            $extension = $this->oClass->extension($img);
                            // $lnh_name = strlen($nombre) > 10 ? substr($nombre, 0, 5) . '-' . generar_letras(4) : $nombre . '-' . generar_letras(4);
                            $lnh_name = strlen($titulo) > 30 ? substr($titulo, 0, 30) : $titulo;
                            $nomtemp = $lnh_name . '.webp';
                            $ruta_usuario = $img['tmp_name'];
                            $conversion = $this->oClass->convertirWebp($extension, $ruta_usuario, __DIR__ . '/../Medios/Webp/' . $nomtemp);
                            if ($conversion) {
                                // $mini = $this->oClass->minificar($lnh_name . '.webp');
                                //guardar en la base de datos
                                $type = "POST::PORT";
                                $idgalery = 0;
                                $img_propietario = $idpost;
                                $request = $this->model->insertImg($type, $nomtemp, $img_propietario, $idgalery);
                                if ($request > 0) {
                                    $textImg .= 'Imagen cargada correctamente.';
                                } else {
                                    $textImg .= 'No se pudo guardar la imagen.';
                                }
                            } else {
                                $textImg .= 'No se pudo convertir la imagen.';
                            }
                        } else {
                            $textImg .= $validacion['text'];
                        }
                        if ($respuesta['status']) {
                            $arrResponse = array('status' => true, 'url' => $slug, 'text' => 'Post creado correctamente. ' . $textImg);
                        }
                    } else {
                        $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'No se pudo crear el post. ' . $respuesta['text']);
                    }
                }
            } else {
                $arrResponse = array('status' => false, 'title' => '', 'icon' => 'warning', 'text' => 'Token invalido');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
