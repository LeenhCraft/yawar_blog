<?php
class SignupExtends extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registrar_usuario($dni = '', $cel = '', $nombre = '', $email = '', $pass = '', $dt = '')
    {
        parent::otro('web');
        if (/*empty($dni) ||*/empty($nombre) || empty($email) || empty($pass) /*|| empty($cel)*/) {
            $arrResponse = array("status" => false, 'icon' => 'warning', 'title' => 'Atención!!', "text" => 'Los campos con * son obligatorios.');
        } else {
            // if (strlen($cel) != 9) {
            //     exit(json_encode(["status" => false, 'icon' => 'warning', 'title' => 'Atención!!', "text" => 'El celular debe tener 9 dígitos.'], JSON_UNESCAPED_UNICODE));
            // }

            // if (strlen($dni) != 8) {
            //     exit(json_encode(["status" => false, 'icon' => 'warning', 'title' => 'Atención!!', "text" => 'El DNI debe tener 8 dígitos.'], JSON_UNESCAPED_UNICODE));
            // }
            $token = generar_letras(20);
            $response = $this->other->insertar($dni, $nombre, $cel, password_hash($pass, PASSWORD_DEFAULT), $email, $token);
            if ($response['status']) {
                $dataEmpresa = $this->other->empresa();
                $urlConfirmacion = base_url() . 'Signup/confirmar/' . $email . '/' . $token . '==';
                $response_email = enviarEmail([
                    'nombre' => $nombre,
                    'email' => $email,
                    'asunto' => NOMBRE_EMPRESA . ' - Activación de cuenta',
                    'urlConfirmacion' => $urlConfirmacion,
                    'empresa' => $dataEmpresa
                ], 'conf_reg');
                // $req_car = $this->other->upd_carrito($response['data']);
                $req_vis = $this->other->upd_visita($response['data']);
                $_SESSION['lnh'] = $response['data'];
                $_SESSION['pe'] = true;
                $html = 'Se envio un email a su correo electronico para completar su registro, por favor revise su bandeja de entrada.' . $response_email['text'];
                $arrResponse = array("status" => true, 'icon' => 'success', 'title' => 'Exito!!', "text" => $html, 'data' => $response['data']);
            } else {
                $arrResponse = array("status" => false, 'icon' => 'warning', 'title' => 'Atención!!', "text" => $response['data']);
            }
        }
        return $arrResponse;
    }
}
