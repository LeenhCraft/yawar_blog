<?php
class YawarTagModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscarTag($slug)
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $table = "SELECT * FROM blog_tags a";
        $inner = $order = $where = "";
        $where = "WHERE a.tag_slug like '$slug' AND a.tag_publicar = 1 AND a.tag_status = 1";
        // $inner = "INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        // $sql = "SELECT * FROM blog_posts WHERE pos_slug like '$slug'";
        $request = $this->select($sql);
        if (!empty($request)) {
            $img = $compWebModel->getImg($request['idtag'], 'TAG::PORT');
            $cant = $this->cantPost($request['idtag']);
            $request['tag_img'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
            $request['tag_cantpost'] = isset($cant['tag_cantpost']) ? $cant['tag_cantpost'] : '0';
        }
        return $request;
    }

    public function cantPost($id)
    {
        $sql = "SELECT COUNT(a.idpost) as tag_cantpost FROM blog_post_tag a WHERE a.idtag = '$id'";
        $request = $this->select($sql);
        return $request;
    }

    public function metaAuthor($id)
    {
        $sql = "SELECT * FROM blog_metaauthors WHERE idwebusuario = $id";
        $request = $this->select($sql);
        return $request;
    }

    public function tagGalleries($id, $limit = 1)
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
                $request[$key]['ga_img'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
            }
        }
        return $request;
    }

    public function post($idtag)
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $table = "SELECT * FROM blog_posts a";
        $inner = $order = $where = "";
        $inner = "INNER JOIN blog_post_tag b ON a.idpost = b.idpost";
        $inner .= " INNER JOIN web_usuarios c ON a.idwebusuario = c.idwebusuario";
        $where = "WHERE b.idtag = '$idtag' AND a.pos_publicar = 1 AND a.pos_status = 1";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        $request = $this->select_all($sql);
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                $img = $compWebModel->getImg($request[$key]['idpost'], 'POST::PORT');
                $request[$key]['pos_tag'] = $compWebModel->getTag($request[$key]['idpost']);
                $request[$key]['pos_img'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
                $request[$key]['aut_meta'] = $this->metaAuthor($request[$key]['idwebusuario']);
            }
        }
        return $request;
    }
}