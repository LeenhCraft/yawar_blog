<?php
class PublicarModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function crearPost($idwebusuario, $idcategorie, $principal, $titulo, $slug, $resumen, $contenido, $publicar, $pos_status)
    {
        $sql = "SELECT * FROM blog_posts WHERE pos_slug = '$slug'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "INSERT INTO blog_posts(idwebusuario,idcategorie,pos_principal,pos_name,pos_slug,pos_extract,pos_body,pos_publicar,pos_status)VALUES(?,?,?,?,?,?,?,?,?)";
            $arrData = [$idwebusuario, $idcategorie, $principal, $titulo, $slug, $resumen, $contenido, $publicar, $pos_status];
            $request_insert = $this->insert($sql, $arrData);
            $return['status'] = true;
            $return['text'] = $request_insert;
        } else {
            $return['status'] = false;
            $return['text'] = "Ya existe un post con el mismo nombre";
        }
        return $return;
    }

    public function actualizarPost($idpost, $idwebusuario, $idcategorie, $principal, $titulo, $slug, $resumen, $contenido, $publicar, $pos_status)
    {
        $sql = "SELECT * FROM blog_posts WHERE pos_slug = '$slug' AND idpost != $idpost";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE blog_posts SET idwebusuario = ?, idcategorie = ?, pos_principal = ?, pos_name = ?, pos_slug = ?, pos_extract = ?, pos_body = ?, pos_publicar = ?, pos_status = ? WHERE idpost = ?";
            // $sql = "INSERT INTO blog_posts(idwebusuario,idcategorie,pos_principal,pos_name,pos_slug,pos_extract,pos_body,pos_publicar,pos_status)VALUES(?,?,?,?,?,?,?,?,?)";
            $arrData = [$idwebusuario, $idcategorie, $principal, $titulo, $slug, $resumen, $contenido, $publicar, $pos_status, $idpost];
            $request_insert = $this->update($sql, $arrData);
            $return['text'] = '';
            $return['status'] = $request_insert;
        } else {
            $return['status'] = false;
            $return['text'] = "Ya existe un post con el mismo nombre";
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

    public function listarGalleries($editar = false)
    {
        $idpost = !$editar ? ' AND a.idpost = 0' : '';
        require_once __DIR__ . '/CompWebModel.php';
        $compWebModel = new CompWebModel();
        $table = "SELECT * FROM blog_galleries a";
        $inner = $order = $where = "";
        $where = "WHERE a.ga_publicar = 1 AND a.ga_status = 1 " . $idpost;
        $order = "ORDER BY a.idgalery DESC";
        $sql = $table . ' ' . $inner . ' ' . $where . ' ' . $order;
        $request = $this->select_all($sql);
        // if (!empty($request)) {
        //     foreach ($request as $key => $value) {
        //         $img = $compWebModel->getImg($request[$key]['idgalery'], 'GALLERY::PORT');
        //         $request[$key]['ga_img_port'] = isset($img['img_url']) ? $img['img_url'] : 'https://via.placeholder.com/1600x2108';
        //     }
        // }
        return $request;
    }

    public function galleryPost($idpost, $slugGallery)
    {
        $sql = "SELECT * FROM blog_galleries WHERE ga_slug = '$slugGallery' AND idpost = 0";
        $request = $this->select($sql);
        if (!empty($request)) {
            $sql = "UPDATE blog_galleries SET idpost = ? WHERE ga_slug = ?";
            $arrData = [$idpost, $slugGallery];
            $request['status'] = $this->update($sql, $arrData);
        } else {
            $request['status'] = false;
            $request['text'] = "No existe la galeria";
        }
        return $request;
    }

    public function updateGalleryPost($idpost, $slugGallery)
    {
        $sql = "UPDATE blog_galleries SET idpost = ? WHERE ga_slug = ?";
        $arrData = [$idpost, $slugGallery];
        $request = $this->update($sql, $arrData);
        if ($request) {
            $sql = "UPDATE blog_galleries SET idpost = ? WHERE idpost = ? AND ga_slug != '$slugGallery'";
            $arrData = [0, $idpost];
            $request2['status'] = $this->update($sql, $arrData);
        } else {
            $request2['status'] = false;
            $request2['text'] = "No existe la galeria";
        }
        return $request2;
    }

    public function tagsPost($idpost, $slugTag)
    {
        $sql = "SELECT idtag FROM blog_tags WHERE tag_slug = '$slugTag'";
        $request = $this->select($sql);
        $id = 0;
        if (!empty($request)) {
            $id = $request['idtag'];
        }

        $sql = "SELECT * FROM blog_post_tag a WHERE a.idpost = $idpost AND a.idtag = $id";
        $request = $this->select_all($sql);
        // dep([$sql, $request]);
        if (empty($request)) {
            // dep('entro');

            $sql = "INSERT INTO blog_post_tag(idpost,idtag)VALUES(?,?)";
            $arrData = [$idpost, $id];
            $request = $this->insert($sql, $arrData);
            return true;
        } else {
            // dep('no entro');
            return false;
        }
    }

    public function updateTagsPost($idpost, $slugTag)
    {
        $sql = "DELETE FROM blog_post_tag WHERE idpost = $idpost";
        $request = $this->delete($sql);

        $sql = "SELECT idtag FROM blog_tags WHERE tag_slug = '$slugTag'";
        $request = $this->select($sql);
        $id = 0;
        if (!empty($request)) {
            $id = $request['idtag'];
        }
        $sql = "SELECT * FROM blog_post_tag a WHERE a.idpost = $idpost AND a.idtag = $id";
        $request = $this->select_all($sql);
        // dep([$sql, $request]);
        if (empty($request)) {
            // dep('entro');

            $sql = "INSERT INTO blog_post_tag(idpost,idtag)VALUES(?,?)";
            $arrData = [$idpost, $id];
            $request = $this->insert($sql, $arrData);
            return true;
        } else {
            // dep('no entro');
            return false;
        }
    }

    public function principalPost($idpost)
    {
        $sql = "SELECT * FROM blog_posts WHERE idpost = $idpost";
        $request = $this->select($sql);
        if (!empty($request)) {
            $sql = "UPDATE blog_posts SET pos_principal = ? WHERE idpost != ?";
            $request['status'] = $this->update($sql, [0, $idpost]);
        } else {
            $request['status'] = false;
            $request['text'] = "No existe el post";
        }
        return $request;
    }
}
