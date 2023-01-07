<?php
class WebModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function centinel($idvisita, $ip = "", $agente = "", $url = '', $method = "")
    {
        $sql = "INSERT INTO sis_centinela(vis_cod,vis_ip,vis_agente,vis_url,vis_method) VALUES (?,?,?,?,?)";
        $arrData = array($idvisita, $ip, $agente, $url, $method);
        $response = $this->insert($sql, $arrData);
        return $response;
    }

    public function chk_vi($vis_cod)
    {
        $sql = "SELECT * FROM web_visitas WHERE vis_cod = '$vis_cod' AND idwebusuario !=0";
        $request = $this->select($sql);
        return $request;
    }

    public function usu($id)
    {
        $sql = "SELECT * FROM web_usuarios WHERE idwebusuario=$id";
        $request = $this->select($sql);
        return empty($request) ? 'sin datos' : $request;
    }

    public function rg_visita($idvisita, $ip = "", $agente = "", $url = '', $method = "")
    {
        $sql = "INSERT INTO web_visitas(vis_cod,vis_ip,vis_agente,vis_url,vis_method) VALUES (?,?,?,?,?)";
        $arrData = array($idvisita, $ip, $agente, $url, $method);
        $response = $this->insert($sql, $arrData);
        return $response;
    }

    public function insertar($dni, $nombre, $cel, $pass, $email, $token)
    {
        $return = $request = [];
        $sql = "SELECT * FROM web_usuarios WHERE usu_usuario like '$email' OR usu_ndoc = '$dni' AND usu_cuenta = 1";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "INSERT INTO web_usuarios(usu_ndoc,usu_nombre,usu_usuario,usu_pass,usu_token,usu_activo,usu_cuenta,usu_cel) VALUES (?,?,?,?,?,?,?,?)";
            $arrData = array($dni, $nombre, $email, $pass, $token, 0, 1, $cel);
            $response = $this->insert($sql, $arrData);
            if ($response > 0) {
                $return['status'] = true;
                $return['data'] = $response;
            } else {
                $return['status'] = false;
                $return['data'] = 'Ocurrio un error al intentar registrar el usuario.';
            }
        } else {
            $return['status'] = false;
            $return['data'] = 'Ya existe una cuenta con este correo electronico/dni. Por favor intente con otro.';
        }
        return $return;
    }

    public function validar($email, $token)
    {
        $return = $request = [];
        $sql = "SELECT * FROM web_usuarios WHERE usu_usuario like '$email' AND usu_token like '$token' AND usu_activo = 0 AND usu_estado = 1";
        $request = $this->select($sql);
        if (!empty($request)) {
            $sql = "UPDATE web_usuarios SET usu_token=?, usu_activo=?, usu_factivo=? WHERE usu_usuario like '$email' AND usu_token like '$token'";
            $arrData = array('', 1, date('Y-m-d H:i:s'));
            $request = $this->update($sql, $arrData);
            if ($request) {
                $return['status'] = true;
                $return['data'] = '';
            } else {
                $return['status'] = false;
                $return['data'] = 'Ocurrio un error al tratar de actualizar el registro.';
            }
        } else {
            $return['status'] = false;
            $return['data'] = 'No se encontro el registro.';
        }
        return $return;
    }

    public function ins_preg($idusuario, $preg, $resp)
    {
        for ($i = 0; $i < count($preg); $i++) {
            $sql = "INSERT INTO sis_preguntas(pre_nombre) VALUES (?)";
            $arrData = array($preg[$i]);
            $request = $this->insert($sql, $arrData);

            $idpreg = $request;

            $sql = "INSERT INTO web_usu_preg(idwebusuario,idpregunta) VALUES (?,?)";
            $arrData = array($idusuario, $idpreg);
            $request = $this->insert($sql, $arrData);

            $sql = "INSERT INTO sis_respuestas(idpregunta,res_valor) VALUES (?,?)";
            $arrData = array($idpreg, $resp[$i]);
            $request = $this->insert($sql, $arrData);
        }
        if ($request) {
            $return['status'] = true;
            $return['data'] = '';
        } else {
            $return['status'] = false;
            $return['data'] = 'Ocurrio un error al tratar de registrar la pregunta y respuesta.';
        }
        return $return;
    }

    public function login($strEmail, $strPassword = "")
    {
        $sql = "SELECT * FROM web_usuarios WHERE usu_usuario like '$strEmail' AND usu_estado = 1";
        $request = $this->select($sql);
        return $request;
    }

    public function first_time()
    {
        $return['primera'] = '0';
        $id = (isset($_SESSION['pe_u'])) ? intval($_SESSION['pe_u']) : 0;
        $sql = "SELECT usu_primera as primera FROM web_usuarios WHERE idwebusuario = '$id'";
        $request = $this->select($sql);

        if ($request > 0) {
            $return['primera'] = $request['primera'];
        }
        return $return;
    }

    public function upd_pswd($pas)
    {
        $idusuario = (isset($_SESSION['pe_u'])) ? intval($_SESSION['pe_u']) : 0;
        $sql = "SELECT * FROM web_usuarios WHERE idwebusuario = '$idusuario'";
        $request = $this->select($sql);

        if (!empty($request)) {
            $pass = password_hash($pas, PASSWORD_DEFAULT);
            $sql = "UPDATE web_usuarios SET usu_pass=?,usu_primera=? WHERE idwebusuario = '$idusuario'";
            $arrData = array($pass, 0);
            $request = $this->update($sql, $arrData);
            if ($request) {
                $return['status'] = true;
                $return['data'] = '';
            } else {
                $return['status'] = false;
                $return['data'] = 'Ocurrio un error al tratar de actualizar el registro.';
            }
        } else {
            $return['status'] = false;
            $return['data'] = 'No existe registros.';
        }
        return $return;
    }

    public function guardarToken($email, $token)
    {
        $return = $request = [];
        $sql = "SELECT * FROM web_usuarios WHERE usu_activo = 1 AND usu_estado = 1 AND usu_usuario like '$email'";
        $request1 = $this->select($sql);

        if (!empty($request1)) {
            $sql = "UPDATE web_usuarios SET usu_token=? WHERE usu_usuario like '$email'";
            $arrData = array($token);
            $request = $this->update($sql, $arrData);
            if ($request) {
                $return['status'] = true;
                $return['data'] = $request1;
            } else {
                $return['status'] = false;
                $return['data'] = 'Ocurrio un error al tratar de actualizar el registro.';
            }
        } else {
            $return['status'] = false;
            $return['data'] = 'Usuario incorrecto.';
        }
        return $return;
    }

    public function validar2($email, $token)
    {
        $return = $request = [];
        $sql = "SELECT * FROM web_usuarios WHERE usu_usuario like '$email' AND usu_token like '$token' AND usu_activo = 1 AND usu_estado = 1";
        $request = $this->select($sql);

        if (!empty($request)) {
            $return['status'] = true;
            $return['data'] = $request;
        } else {
            $return['status'] = false;
            $return['data'] = 'Usuario incorrecto.';
        }
        return $return;
    }

    public function dataUser(string $email)
    {
        $sql = "SELECT * FROM web_usuarios a WHERE a.usu_usuario like '$email'";
        $request = $this->select($sql);
        return $request;
    }

    public function getUser(int $idusuario)
    {
        $sql = "SELECT * FROM web_usuarios a WHERE a.idwebusuario like '$idusuario'";
        $request = $this->select($sql);
        return $request;
    }

    public function upd_recuperar($idwebusuario, $pass)
    {
        $return = $request = [];
        $sql = "SELECT * FROM web_usuarios WHERE usu_activo = 1 AND usu_estado = 1 AND idwebusuario = '$idwebusuario'";
        $request1 = $this->select($sql);

        if (!empty($request1)) {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "UPDATE web_usuarios SET usu_pass=?,usu_token=?,usu_primera=? WHERE idwebusuario = '$idwebusuario'";
            $arrData = array($pass, '', 1);
            $request = $this->update($sql, $arrData);
            if ($request) {
                // $sql = "SELECT * FROM sis_intentos WHERE idwebusuario = '$idwebusuario' AND int_delete = 0 ORDER BY idintento DESC LIMIT 1";
                // $request = $this->select($sql);
                // if (!empty($request)) {
                //     $sql = "UPDATE sis_intentos SET int_delete=? WHERE idwebusuario = ?";
                //     $arrData = array(1, $idwebusuario);
                //     $request = $this->update($sql, $arrData);
                // }
                $return['status'] = true;
                $return['data'] = $request1;
            } else {
                $return['status'] = false;
                $return['data'] = 'Ocurrio un error al tratar de actualizar el registro.';
            }
        } else {
            $return['status'] = false;
            $return['data'] = 'No existe usuario.';
        }
        return $return;
    }

    public function masVisitado($vis_cod, $idarticulo, $url)
    {
        $sql = "SELECT * FROM blog_masvisitados WHERE vis_cod = $vis_cod AND idpost = $idarticulo";
        $response = $this->select_all($sql);
        if (empty($response)) {
            $sql = "INSERT INTO blog_masvisitados(vis_cod,idpost,mas_url) VALUES (?,?,?)";
            $arrData = array($vis_cod, $idarticulo, $url);
            $response = $this->insert($sql, $arrData);
        }
        return $response;
    }

    public function empresa()
    {
        $sql = "SELECT * FROM sis_empresas WHERE emp_estado = 1";
        $request = $this->select($sql);
        return $request;
    }

    public function upd_visita($idwebusuario)
    {
        $vis_cod = $_SESSION['vi'];
        $sql = "UPDATE web_visitas SET idwebusuario = ? WHERE vis_cod = ?";
        $arrData = array($idwebusuario, $vis_cod);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function upd_centinela($idwebusuario)
    {
        $vis_cod = $_SESSION['vi'];
        $sql = "UPDATE sis_centinela SET idwebusuario = ? WHERE vis_cod = ?";
        $arrData = array($idwebusuario, $vis_cod);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function listCombo()
    {
        $sql = "SELECT idfilial as nmr, fi_nombre as nombre FROM ym_filiales WHERE fi_status = 1";
        $request = $this->select_all($sql);
        if (count($request) == 0) {
            $request = array(array('nmr' => '', 'nombre' => 'Sin datos, registre algunos'));
        }
        return $request;
    }
}
