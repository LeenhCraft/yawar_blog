<?php
class LeenhModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function verLogo($type)
    {
        $sql = "SELECT * FROM blog_images WHERE img_type = '{$type}' ORDER BY idimage DESC LIMIT 1";
        $request = $this->select($sql);
        return $request;
    }

    public function insertImg($type, $lnh_name, $img_propietario, $idgalery)
    {
        $sql = "INSERT INTO blog_images (img_type, img_url, img_propietario, idgalery) VALUES (?,?,?,?)";
        $arrData = array($type, $lnh_name, $img_propietario, $idgalery);
        $request = $this->insert($sql, $arrData);
        return $request;
    }

    public function updateImg($id, $type, $url)
    {
        $sql = "UPDATE blog_images SET img_url = ? WHERE idimage = ? AND img_type=?";
        $arrData = array($url, $id, $type);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
