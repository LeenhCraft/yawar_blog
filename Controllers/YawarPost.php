<?php
class YawarPost extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        $url = urls();
        parent::otra_clase('Clases', 'CompWeb');
        $this->oClass->linksfooter = false;
        parent::otro('CompWeb');
        $data['titulo_web'] = "Yawar.:Post";
        $data['componentes'] = $this->oClass->compweb(["principal"]);
        $data['post'] = $this->model->buscarPost($url['method']);
        if (!empty($data['post'])) {
            $data['postrandom'] = $this->other->randoPost(3);
            $data['older'] = $this->model->postOlder($data['post']['pos_date'], 1);
            $data['next'] = $this->model->postNext($data['post']['pos_date'], 1);
            $data['gallery'] = $this->model->postGalleries($data['post']['idpost'], 2);
            // parent::otro('Leenh');
            // $data['img_port'] = $data['post']['pos_img'];
            parent::otro('Web');
            $this->other->masVisitado($_SESSION['vi'], $data['post']['idpost'], $url['method']);
            // dep($data, 1);
            if (isset($_SESSION['_cf'])) {
                $data['editar'] = true;
            }
            if (isset($url['params']) && strtolower($url['params']) === "editar") {
                $data['editar'] = true;
                // dep('aqui',1);
                parent::otra_clase('Clases', 'CompWeb');
                $this->oClass->linksfooter = false;
                $data['titulo_web'] = "Publicar";
                $this->oClass->esloganfooter = false;
                $data['componentes'] = $this->oClass->compweb(["principal"]);
                parent::otro("YawarTag");
                $data['tags'] = $this->other->listarTags();
                parent::otro("Publicar");
                $data['gallery'] = $this->other->listarGalleries(true);
                $data['csrf'] = getTokenCsrf();
                //documentacion de la libreria
                /*https://www.jqueryscript.net/form/tags-selector-tagselect.html#google_vignette*/
                $data['js'] = ['js/jquery.tagselect.js', 'js/update.post.js'];
                $data['css'] = ['css/jquery.tagselect.css', 'css/lnh.grid.css', 'css/create.post.css'];
                $data['titulo_view'] = "Editar Post";
                $arraTag = [];
                $arrPosTag = [];
                foreach ($data['tags'] as $tag) {
                    array_push($arraTag, $tag['tag_slug']);
                }

                foreach ($data['post']['pos_tag'] as $tag) {
                    array_push($arrPosTag, $tag['tag_slug']);
                }
                $data['arrTag'] = $arraTag;
                $data['arrPosTag'] = $arrPosTag;
                $data['create-post'] = 'onsubmit="updatePost(this,event)"';
                // dep($data, 1);
                $this->views->getView('Web/Publicar', 'Index', $data);
            } else {
                $data['css'] = ['css/create.post.css'];
                $this->views->getView('Web/Post', 'Index', $data);
            }
        } else {
            require_once __DIR__ . '/Error.php';
            $classError = new Errors();
            $classError->notFound();
        }
        // if (method_exists($this, $url['method'])) {
        //     echo 'Method exists';
        //     $this->{$url['method']}();
        // }
        exit();
    }
}
