<?php
class ImageClassModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
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
}
