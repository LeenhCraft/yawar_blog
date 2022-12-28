<?php
class AccountModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function updImgPerfil($lnh_name, $idwebusuario)
    {
        $sql = "UPDATE web_usuarios SET usu_foto = ? WHERE idwebusuario = ?";
        $arrData = array($lnh_name, $idwebusuario);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
