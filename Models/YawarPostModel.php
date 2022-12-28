<?php
class YawarPostModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscarPost($slug)
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $table = "SELECT * FROM blog_posts a";
        $inner = $order = $where = "";
        // $where = "WHERE a.pos_slug like '$slug' AND a.pos_publicar = 1 AND a.pos_status = 1";
        $where = isset($_SESSION['_cf']) && $_SESSION['_cf'] === 'ok' ? "WHERE a.pos_slug like '$slug'" : "WHERE a.pos_slug like '$slug' AND a.pos_publicar = 1 AND a.pos_status = 1";
        $inner = "INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        // $sql = "SELECT * FROM blog_posts WHERE pos_slug like '$slug'";
        $request = $this->select($sql);
        // dep($sql, 1);
        if (!empty($request)) {
            $img = $compWebModel->getImg($request['idpost'], 'POST::PORT');
            $imgAut = $compWebModel->getUser($request['idwebusuario']);
            $request['pos_tag'] = $compWebModel->getTag($request['idpost']);
            $request['pos_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
            $request['aut_img'] = isset($imgAut['usu_foto']) ? $imgAut['usu_foto'] : img_404();
            $aut_meta = $this->metaAuthor($request['idwebusuario']);
            $request['aut_meta'] = !empty($aut_meta) ? $aut_meta : [];
            $request['pos_gallery'] = !empty($this->postGalleries($request['idpost'])) ? $this->postGalleries($request['idpost'])[0] : [];
            $request['pos_destacado'] = $this->postDestacado($request['idpost']);
        }
        return $request;
    }

    public function metaAuthor($id)
    {
        $sql = "SELECT * FROM blog_metaauthors WHERE idwebusuario = $id";
        $request = $this->select($sql);
        return $request;
    }

    public function postOlder($date, $limit = 1)
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $sql = "SELECT * FROM blog_posts a 
        INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario 
        WHERE a.pos_date < '$date' AND a.pos_publicar = 1 AND a.pos_status = 1 
        ORDER BY a.idpost 
        DESC LIMIT $limit;";
        $request = $this->select($sql);
        if (!empty($request)) {
            $img = $compWebModel->getImg($request['idpost'], 'POST::PORT');
            $request['pos_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
            $request['pos_tag'] = $compWebModel->getTag($request['idpost']);
        }

        return $request;
    }

    public function postNext($date, $limit = 1)
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $sql = "SELECT * FROM blog_posts a 
        INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario 
        WHERE a.pos_date > '$date' AND a.pos_publicar = 1 AND a.pos_status = 1 
        ORDER BY a.idpost ASC
        LIMIT $limit;";
        $request = $this->select($sql);
        if (!empty($request)) {
            $img = $compWebModel->getImg($request['idpost'], 'POST::PORT');
            $request['pos_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
            $request['pos_tag'] = $compWebModel->getTag($request['idpost']);
        }
        return $request;
    }

    public function postGalleries($id, $limit = 1)
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $sql = "SELECT * FROM blog_galleries a 
        WHERE a.idpost = '$id' AND a.ga_publicar = 1 AND a.ga_status = 1 
        ORDER BY a.ga_date DESC
        LIMIT $limit";
        $request = $this->select_all($sql);
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                $img = $compWebModel->getImg($request[$key]['idgalery'], 'GALLERY::PORT');
                $request[$key]['ga_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
            }
        }
        return $request;
    }

    public function postDestacado($id)
    {
        $sql = "SELECT * FROM blog_postdestacados WHERE idpost = $id";
        $request = $this->select($sql);
        if (empty($request)) {
            $request = [];
        }
        return $request;
    }
}
