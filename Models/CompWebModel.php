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

    public function getUser($id = 0)
    {
        $sql = "SELECT * FROM web_usuarios WHERE idwebusuario = $id";
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
        $sql = "SELECT * FROM blog_tags WHERE tag_status = 1 AND tag_publicar = 1";
        $request = $this->select_all($sql);
        $nData = [];
        foreach ($request as $key => $value) {
            // $sql = "SELECT * FROM blog_images WHERE img_propietario = {$value['idtag']} AND img_type = 'TAG::PORT'";
            $requestImg = $this->getImg($value['idtag'], 'TAG::PORT');
            $nData[$key] = $value;
            $nData[$key]['tag_img'] = isset($requestImg['img_url']) ? $requestImg['img_url'] : img_404();
        }
        return $nData;
    }

    public function posts($tipo = 1, $offset = 0, $limit = 6)
    {
        $inner = $order = $where = $and = "";
        $table = "SELECT * FROM blog_posts a";
        // $and = isset($_SESSION['_cf']) && $_SESSION['_cf'] === 'ok' ? "a.pos_publicar = 0" : "a.pos_publicar = 1";
        switch ($tipo) {
            case $tipo == 1: //post destacado
                $inner = "INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario";
                $where = "WHERE a.pos_principal = 1 AND a.pos_publicar = 1 AND a.pos_status = 1";
                break;
            case $tipo == 2: //lista de posts
                $inner = "INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario";
                // $where = "WHERE a.pos_status = 1 $and";
                $where = isset($_SESSION['_cf']) && $_SESSION['_cf'] === 'ok' ? "" : "WHERE a.pos_status = 1 AND a.pos_publicar = 1";
                $order = "ORDER BY a.pos_date DESC LIMIT $offset,$limit";
                break;
            case $tipo == '3': //post del usuario
                $inner = "INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario";
                $where = "WHERE a.pos_publicar = 1 AND a.pos_status = 1 AND b.idwebusuario = " . $_SESSION['lnh'];
                $order = "ORDER BY a.pos_date DESC LIMIT $offset,$limit";
                break;
            default:
                $inner = $order = $where = "";
                break;
        }
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        // dep($sql);
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
                $request['pos_img'] = isset($img['img_url']) ? img_post() . $img['img_url'] : img_404();
                $request['aut_img'] = isset($imgAut['img_url']) ? img_user() . $imgAut['img_url'] : img_404();
                $request['pos_tag'] = $this->getTag($request['idpost']);
                break;
            case 2: //lista de posts
                $request = $this->select_all($sql);
                foreach ($request as $key => $value) {
                    $img = $this->getImg($value['idpost'], 'POST::PORT');
                    $imgAut = $this->getImg($value['idwebusuario'], 'USER::PORT');
                    $request[$key]['pos_img'] = isset($img['img_url']) ? img_post() . $img['img_url'] : img_404();
                    $request[$key]['aut_img'] = isset($imgAut['img_url']) ? img_user() . $imgAut['img_url'] : img_404();
                    $request[$key]['pos_tag'] = $this->getTag($value['idpost']);
                }
                break;
            case 3: //post del usuario
                $request = $this->select_all($sql);
                foreach ($request as $key => $value) {
                    $img = $this->getImg($value['idpost'], 'POST::PORT');
                    $imgAut = $this->getImg($value['idwebusuario'], 'USER::PORT');
                    $request[$key]['pos_img'] = isset($img['img_url']) ? img_post() . $img['img_url'] : img_404();
                    $request[$key]['aut_img'] = isset($imgAut['img_url']) ? img_user() . $imgAut['img_url'] : img_404();
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
            $request[$key]['pos_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
            $request[$key]['aut_img'] = isset($imgAut['img_url']) ? $imgAut['img_url'] : img_404();
            $request[$key]['pos_tag'] = $this->getTag($value['idpost']);
        }
        return $request;
    }

    public function randoPost($limit = 2)
    {
        $sql = "SELECT * FROM blog_posts a INNER JOIN web_usuarios b ON a.idwebusuario = b.idwebusuario WHERE a.pos_publicar = 1 AND a.pos_status = 1 ORDER BY RAND() LIMIT $limit";
        $request = $this->select_all($sql);
        foreach ($request as $key => $value) {
            $img = $this->getImg($value['idpost'], 'POST::PORT');
            $request[$key]['pos_img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
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
            $nData[$key]['ga_img'] = isset($requestImg['img_url']) ? $requestImg['img_url'] : img_404();
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
            $nData[$key]['gr_links'] = $requestImg;
        }
        return $nData;
    }

    public function buscarPost($parametro, $offset = 0, $limit = 10)
    {
        $like = $parametro != "" ? "AND a.pos_name LIKE '%$parametro%'" : '';
        $limit = $parametro != "" ? "LIMIT $offset,$limit" : '';
        $sql = "SELECT a.idpost as num, a.pos_name as title, a.pos_slug as slug, a.pos_date as 'date' FROM blog_posts a WHERE a.pos_publicar = 1 AND a.pos_status = 1 $like ORDER BY a.idpost DESC $limit";
        $request = $this->select_all($sql);
        foreach ($request as $key => $value) {
            $img = $this->getImg($value['num'], 'POST::PORT');
            $request[$key]['img'] = isset($img['img_url']) ? $img['img_url'] : img_404();
            // $request[$key]['pos_tag'] = $this->getTag($value['idpost']);
        }
        return $request;
    }

    public function register()
    {
        $img = $this->getImg(0, 'INDEX::CONT');
        $request['img'] = isset($img['img_url']) ? img_other() . $img['img_url'] : img_404();
        return $request;
    }
}
