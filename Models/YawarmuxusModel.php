<?php
class YawarmuxusModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listCombo()
    {
        $sql = "SELECT idfilial as nmr, fi_nombre as nombre FROM ym_filiales";
        $request = $this->select_all($sql);
        if (count($request) == 0) {
            $request = array(array('nmr' => '', 'nombre' => 'Sin datos, registre algunos'));
        }
        return $request;
    }

    public function buscar($dni)
    {
        $sql = "SELECT idintegrante FROM ym_integrantes WHERE in_dni = $dni";
        $request = $this->select($sql);

        if ($request > 0) {
            $request['status'] = true;
        } else {
            $request['status'] = false;
        }
        return $request;
    }

    public function insertar($nombre, $dni, $cel, $filial, $idApoderado)
    {
        $sql_participante = "INSERT INTO ym_integrantes(in_dni,in_nombre,in_celular,in_apoderado)VALUES(?,?,?,?)";
        $datos = array($dni, $nombre, $cel, $idApoderado);
        $rp1 = $this->insert($sql_participante, $datos);
        if ($rp1) {
            $buscar = $this->buscar($dni);
            if ($buscar['status']) {
                $sql_fi_in = "INSERT INTO ym_filial_integrante(idintegrante,idfilial)VALUES(?,?)";
                $datos2 = array($buscar['idintegrante'], $filial);
                $rp2 = $this->insert($sql_fi_in, $datos2);
                if ($rp2) {
                    $estado = true;
                } else {
                    $estado = false;
                }
            } else {
                $estado = false;
            }
        } else {
            $estado = false;
        }
        return $estado;
    }

    public function actualizar($id, $nombre, $filial, $cel)
    {
        $sql = "UPDATE ym_filial_integrante a 
        INNER JOIN ym_integrantes b ON b.idintegrante=a.idintegrante
        SET a.idfilial=?,b.in_celular=?,b.in_nombre=?
        WHERE a.idfilialintegrante=$id";
        $var = array($filial, $cel, $nombre);
        $resp = $this->update($sql, $var);
        return $resp;
    }

    public function eliminar(int $id)
    {
        $sql = "DELETE ym_filial_integrante,ym_integrantes FROM ym_filial_integrante
        JOIN ym_integrantes ON ym_integrantes.idintegrante = ym_filial_integrante.idintegrante
        WHERE ym_filial_integrante.idfilialintegrante = $id";
        $request = $this->delete($sql);
        return $request;
    }

    public function insertarApoderado($dniApoderado, $nombreApoderado, $phoneApoderado)
    {
        $sql_participante = "INSERT INTO ym_integrantes(in_dni,in_nombre,in_celular)VALUES(?,?,?)";
        $datos = array($dniApoderado, $nombreApoderado, $phoneApoderado);
        $rp = $this->insert($sql_participante, $datos);
        return $rp;
    }
}
