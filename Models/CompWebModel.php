<?php
class CompWebModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getImg($id = 0, $type = "")
    {
        $sql = "SELECT * FROM blog_images WHERE img_propietario = $id AND img_type = '$type'";
        $request = $this->select($sql);
        return $request;
    }

    public function getTag($id = 0)
    {
        $sql = "SELECT * FROM blog_post_tag a 
        INNER JOIN blog_tags b ON a.idtag=b.idtag 
        WHERE a.idpost = $id AND b.tag_publicar = 1 AND b.tag_status = 1 ";
        $request = $this->select_all($sql);
        return $request;
    }

    public function menus()
    {
        $sql = "SELECT * FROM blog_menus WHERE me_status = 1";
        $request = $this->select_all($sql);
        return $request;
    }

    public function sloganPrincipal()
    {
        $sql = "SELECT * FROM blog_slogans WHERE sl_principal = 1 AND sl_status = 1";
        $request = $this->select($sql);
        return $request;
    }

    public function listTags()
    {
        $sql = "SELECT * FROM blog_tags WHERE tag_status = 1";
        $request = $this->select_all($sql);
        $nData = [];
        foreach ($request as $key => $value) {
            // $sql = "SELECT * FROM blog_images WHERE img_propietario = {$value['idtag']} AND img_type = 'TAG::PORT'";
            $requestImg = $this->getImg($value['idtag'], 'TAG::PORT');
            $nData[$key] = $value;
            $nData[$key]['tag_img'] = isset($requestImg['img_url']) ? $requestImg['img_url'] : 'https://via.placeholder.com/300x375';
        }
        return $nData;
    }

    public function posts($tipo = 1)
    {
        $inner = $order = $where = "";
        $table = "SELECT * FROM blog_posts a";
        switch ($tipo) {
            case $tipo == 1: //post destacado
                $where = "WHERE a.pos_principal = 1 AND a.pos_publicar = 1 AND a.pos_status = 1";
                $inner = "INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario";
                break;
            case $tipo == 2: //lista de posts
                $offset = 0;
                $limit = 6;
                $order = "ORDER BY a.pos_date DESC LIMIT $offset,$limit";
                $inner = "INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario";
                $where = "WHERE a.pos_publicar = 1 AND a.pos_status = 1";
                break;

            default:
                $inner = $order = $where = "";
                break;
        }
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        switch ($tipo) {
            case 1: //post destacado
                $request = $this->select($sql);
                if (empty($request)) {
                    $where = "WHERE a.pos_publicar = 1 AND a.pos_status = 1";
                    $order = "ORDER BY a.pos_date DESC";
                    $request = $this->select($table . ' ' . $inner . ' ' . $where . ' ' . $order);
                }
                $img = $this->getImg($request['idpost'], 'POST::PORT');
                $imgAut = $this->getImg($request['idwebusuario'], 'USER::PORT');
                $request['pos_img'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
                $request['aut_img'] = isset($imgAut['img_url']) ? $imgAut['img_url'] : 'https://via.placeholder.com/300x49';
                $request['pos_tag'] = $this->getTag($request['idpost']);
                break;
            case 2: //lista de posts
                $request = $this->select_all($sql);
                foreach ($request as $key => $value) {
                    $img = $this->getImg($value['idpost'], 'POST::PORT');
                    $imgAut = $this->getImg($value['idwebusuario'], 'USER::PORT');
                    $request[$key]['pos_img'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
                    $request[$key]['aut_img'] = isset($imgAut['img_url']) ? $imgAut['img_url'] : 'https://via.placeholder.com/300x49';
                    $request[$key]['pos_tag'] = $this->getTag($value['idpost']);
                }
                break;
            default:
                # code...
                break;
        }
        return $request;
    }

    public function postDesta($off = 0, $limit = 3)
    {
        $sql = "SELECT * FROM blog_postdestacados a 
        INNER JOIN blog_posts b ON b.idpost = a.idpost 
        INNER JOIN web_usuarios c ON c.idwebusuario = b.idwebusuario
        WHERE b.pos_publicar = 1 AND b.pos_status = 1 LIMIT $off,$limit";
        $request = $this->select_all($sql);
        foreach ($request as $key => $value) {
            $img = $this->getImg($value['idpost'], 'POST::PORT');
            $imgAut = $this->getImg($value['idwebusuario'], 'USER::PORT');
            $request[$key]['pos_img'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
            $request[$key]['aut_img'] = isset($imgAut['img_url']) ? $imgAut['img_url'] : 'https://via.placeholder.com/300x49';
            $request[$key]['pos_tag'] = $this->getTag($value['idpost']);
        }
        return $request;
    }

    public function randoPost()
    {
        $sql = "SELECT * FROM blog_posts a INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario WHERE a.pos_publicar = 1 AND a.pos_status = 1 ORDER BY RAND() LIMIT 2";
        $request = $this->select_all($sql);
        foreach ($request as $key => $value) {
            $img = $this->getImg($value['idpost'], 'POST::PORT');
            $request[$key]['pos_img'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
            $request[$key]['pos_tag'] = $this->getTag($value['idpost']);
        }
        return $request;
    }

    public function galleries($off = 0, $limit = 6)
    {
        $sql = "SELECT * FROM blog_galleries a WHERE a.ga_publicar = 1 AND a.ga_status = 1 ORDER BY a.idgalery DESC LIMIT $off,$limit";
        $request = $this->select_all($sql);
        $nData = [];
        foreach ($request as $key => $value) {
            // $sql = "SELECT * FROM blog_images WHERE idgalery = {$value['idgalery']} AND img_type = 'GALLERY::PORT'";
            $requestImg = $this->getImg($value['idgalery'], 'GALLERY::PORT');
            $nData[$key] = $value;
            $nData[$key]['ga_img'] = isset($requestImg['img_url']) ? $requestImg['img_url'] : 'https://via.placeholder.com//600x900';
        }
        return $nData;
    }

    public function sloganFooter()
    {
        $sql = "SELECT * FROM blog_slogans WHERE sl_principal = 0 AND sl_status = 1";
        $request = $this->select($sql);
        return $request;
    }

    public function linksFooter($off = 0, $limit = 6)
    {
        $sql = "SELECT * FROM blog_grouplinks a WHERE a.gr_status = 1 ORDER BY a.idgroup ASC LIMIT $off,$limit";
        $request = $this->select_all($sql);
        $nData = [];
        foreach ($request as $key => $value) {
            $sql = "SELECT * FROM blog_links WHERE idgroup = {$value['idgroup']} AND li_status = 1";
            $requestImg = $this->select_all($sql);
            $nData[$key] = $value;
            $nData[$key]['ga_links'] = $requestImg;
        }
        return $nData;
    }
}
