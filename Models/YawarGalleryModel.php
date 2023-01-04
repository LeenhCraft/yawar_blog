<?php
class YawarGalleryModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscarGallery($slug)
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $table = "SELECT * FROM blog_galleries a";
        $inner = $order = $where = "";
        $where = isset($_SESSION['_cf']) && $_SESSION['_cf'] === 'ok' ? "WHERE a.ga_slug like '$slug'" : "WHERE a.ga_slug like '$slug' AND a.ga_publicar = 1 AND a.ga_status = 1";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        $request = $this->select($sql);
        if (!empty($request)) {
            $img = $compWebModel->getImg($request['idgalery'], 'GALLERY::PORT');
            $request['ga_img_port'] = isset($img['img_url']) ? img_gallery() . $img['img_url'] : img_404();
        }
        return $request;
    }

    public function listarGalleries()
    {
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $table = "SELECT * FROM blog_galleries a";
        $inner = $order = $where = "";
        $where = isset($_SESSION['_cf']) && $_SESSION['_cf'] === 'ok' ? "" : "WHERE a.ga_publicar = 1 AND a.ga_status = 1";
        $order = "ORDER BY a.idgalery DESC";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        $request = $this->select_all($sql);
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                $img = $compWebModel->getImg($request[$key]['idgalery'], 'GALLERY::PORT');
                $request[$key]['ga_img_port'] = isset($img['img_url']) ? img_gallery() . $img['img_url'] : img_404();
            }
        }
        return $request;
    }

    public function images($idgallery)
    {
        $table = "SELECT * FROM blog_images a";
        $inner = $order = $where = "";
        $where = "WHERE a.idgalery = '$idgallery' AND a.img_type = 'GALLERY::CONT'";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        $request = $this->select_all($sql);
        return $request;
    }

    public function postAsociados($idgallery)
    {
        require_once __DIR__ . '/CompWebModel.php';
        require_once __DIR__ . '/YawarPostModel.php';
        $compWebModel = new CompWebModel();
        $yawarPostModel = new YawarPostModel();
        $table = "SELECT * FROM blog_posts a";
        $inner = $order = $where = "";
        $inner = "INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario";
        $inner .= " INNER JOIN blog_galleries c ON c.idpost = a.idpost";
        $where = "WHERE c.idgalery = '$idgallery' AND a.pos_publicar = 1 AND a.pos_status = 1";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        $request = $this->select($sql);
        if (!empty($request)) {
            $img = $compWebModel->getImg($request['idpost'], 'POST::PORT');
            $imgAut = $compWebModel->getImg($request['idwebusuario'], 'USER::PORT');
            $request['pos_tag'] = $compWebModel->getTag($request['idpost']);
            $request['pos_img'] = isset($img['img_url']) ? img_post() . $img['img_url'] : img_404();
            $request['aut_img'] = isset($imgAut['img_url']) ? img_user() . $imgAut['img_url'] : img_404();
            $request['aut_meta'] = $yawarPostModel->metaAuthor($request['idwebusuario']);
        }
        return $request;
    }

    public function insertGal($name, $slug)
    {
        $sql = "SELECT * FROM blog_galleries WHERE ga_name = '$name' OR ga_slug = '$slug'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert = "INSERT INTO blog_galleries(ga_name,ga_slug) VALUES(?,?)";
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

    public function updateGal($gallery, $slug, $idgallery, $publicar, $status)
    {
        $sql = "UPDATE blog_galleries SET ga_name = ?, ga_slug = ?, ga_publicar = ?, ga_status = ? WHERE idgalery = ?";
        $arrData = array($gallery, $slug, $publicar, $status, $idgallery);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function updPostAso($post, $idgalery)
    {
        $sql = "UPDATE blog_galleries SET idpost = ? WHERE idgalery = ?";
        $arrData = array($post, $idgalery);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function insImgGal($type, $lnh_name, $img_propietario, $idgalery)
    {
        $sql = "INSERT INTO blog_images (img_type, img_url, img_propietario, idgalery) VALUES (?,?,?,?)";
        $arrData = array($type, $lnh_name, $img_propietario, $idgalery);
        $request = $this->insert($sql, $arrData);
        return $request;
    }

    public function delImgGal($idimage, $idgalery)
    {
        $sql = "DELETE FROM blog_images WHERE idimage = $idimage AND idgalery = $idgalery";
        $arrData = array($idimage, $idgalery);
        $request = $this->delete($sql, $arrData);
        return $request;
    }

    public function delPostAso($idgalery, $idpost)
    {
        $sql = "UPDATE blog_galleries SET idpost = '0' WHERE idgalery = ? AND idpost = ?";
        $arrData = array($idgalery, $idpost);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function updateImg($lnh_name, $img_propietario, $type)
    {
        $sql = "UPDATE blog_images SET img_url = ? WHERE img_propietario = ? AND img_type = ?";
        $arrData = array($lnh_name, $img_propietario, $type);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
