<?php
class YawarTagModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listarTags()
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $table = "SELECT * FROM blog_tags a";
        $inner = $order = $where = "";
        $where = "WHERE a.tag_publicar = 1 AND a.tag_status = 1";
        $order = "ORDER BY a.idtag DESC";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        $request = $this->select_all($sql);
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                $img = $compWebModel->getImg($request[$key]['idtag'], 'TAG::PORT');
                $cant = $this->cantPost($request[$key]['idtag']);
                $request[$key]['tag_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
                $request[$key]['tag_cantpost'] = isset($cant['tag_cantpost']) ? $cant['tag_cantpost'] : '0';
            }
        }
        return $request;
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
            $request['tag_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
            $request['tag_cantpost'] = isset($cant['tag_cantpost']) ? $cant['tag_cantpost'] : '0';
        }
        return $request;
    }

    public function cantPost($id)
    {
        // $sql = "SELECT COUNT(a.idpost) as tag_cantpost FROM blog_post_tag a WHERE a.idtag = '$id'";
        $sql = "SELECT COUNT(a.idpost) as tag_cantpost FROM blog_post_tag a INNER JOIN blog_posts b ON b.idpost = a.idpost WHERE a.idtag = '$id' AND b.pos_publicar = 1 AND b.pos_status = 1";
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
                $request[$key]['ga_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
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
        $where = "WHERE b.idtag = '$idtag' ";
        $where .= isset($_SESSION['_cf']) && $_SESSION['_cf'] == 'ok' ? " " : " AND a.pos_publicar = 1 AND a.pos_status = 1";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        // dep($sql);
        $request = $this->select_all($sql);
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                $img = $compWebModel->getImg($request[$key]['idpost'], 'POST::PORT');
                $request[$key]['pos_tag'] = $compWebModel->getTag($request[$key]['idpost']);
                $request[$key]['pos_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
                $request[$key]['aut_meta'] = $this->metaAuthor($request[$key]['idwebusuario']);
            }
        }
        return $request;
    }

    public function insertTag($name, $slug)
    {
        $sql = "SELECT * FROM blog_tags WHERE tag_name = '$name' OR tag_slug = '$slug'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO blog_tags(tag_name,tag_slug) VALUES(?,?)";
            $arrData = array($name, $slug);
            $request_insert = $this->insert($query_insert, $arrData);
            $return['status'] = true;
            $return['text'] = $request_insert;
        } else {
            $return['status'] = false;
            $return['text'] = "exist";
        }
        return $return;
    }

    public function insertImg($type, $lnh_name, $img_propietario, $idgalery)
    {
        $sql = "INSERT INTO blog_images (img_type, img_url, img_propietario, idgalery) VALUES (?,?,?,?)";
        $arrData = array($type, $lnh_name, $img_propietario, $idgalery);
        $request = $this->insert($sql, $arrData);
        return $request;
    }

    public function updateImg($lnh_name, $img_propietario, $type)
    {
        $sql = "UPDATE blog_images SET img_url = ? WHERE img_propietario = ? AND img_type = ?";
        $arrData = array($lnh_name, $img_propietario, $type);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function updateTag($tag, $slug, $idtag)
    {
        $sql = "UPDATE blog_tags SET tag_name = ?, tag_slug = ? WHERE idtag = ?";
        $arrData = array($tag, $slug, $idtag);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
