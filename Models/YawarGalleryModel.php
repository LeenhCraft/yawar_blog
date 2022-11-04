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
        $where = "WHERE a.ga_slug like '$slug' AND a.ga_publicar = 1 AND a.ga_status = 1";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        $request = $this->select($sql);
        if (!empty($request)) {
            $img = $compWebModel->getImg($request['idgalery'], 'GALLERY::PORT');
            $request['ga_img_port'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
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
            $request['pos_img'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
            $request['aut_img'] = isset($imgAut['img_url']) ? $imgAut['img_url'] : 'https://via.placeholder.com/300x49';
            $request['aut_meta'] = $yawarPostModel->metaAuthor($request['idwebusuario']);
        }
        return $request;
    }
}
