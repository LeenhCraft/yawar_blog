<?php
require_once __DIR__ . '/../Libraries/vendor/autoload.php';
//para leer los dispositivos
use UAParser\Parser;
// para enviar correo electronico
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Retorna la url del proyecto
function base_url()
{
    return BASE_URL;
}

function path_post()
{
    return base_url() . 'yawarpost/';
}

function path_tag()
{
    return base_url() . 'yawartag/';
}

function path_gallery()
{
    return base_url() . 'yawargallery/';
}

function path_author()
{
    return base_url() . 'yawarautor/';
}

function path_recursos()
{
    return base_url() . 'Medios/';
}

function path_mini()
{
    return base_url() . 'Medios/Mini/';
}

function path_img_404()
{
    return path_recursos() . img_404();
}

function img_404()
{
    return '404/404.webp';
}

function img_post()
{
    return 'Posts/';
}

function img_user()
{
    return 'Users/';
}

function img_tag()
{
    return 'Tags/';
}

function img_gallery()
{
    return 'Galleries/';
}

function img_other()
{
    return 'Other/';
}

function img_logo()
{
    return 'Logo/';
}

function dir_recursos()
{
    return __DIR__ . '/../Medios/';
}

function media()
{
    return BASE_URL . "Assets/";
}

function headerWeb($view, $data = "")
{
    $logo = [];
    require_once __DIR__ . '/../Models/LeenhModel.php';
    $oClass = new LeenhModel();
    $logo = $oClass->verLogo('LOGO::IMG');
    $backImg = $oClass->verLogo('BACK::WEB');
    $view_header = "Views/Web/Template/$view.php";
    require_once $view_header;
}

function footerWeb($view, $data = "")
{
    require_once __DIR__ . '/../Models/LeenhModel.php';
    $oClass = new LeenhModel();
    $logo = $oClass->verLogo('LOGO::IMG');
    $view_footer = "Views/Web/Template/$view.php";
    require_once $view_footer;
}

function headerApp($view, $data = "")
{
    $view_header = "Views/App/$view.php";
    require_once $view_header;
}

function footerApp($view, $data = "")
{
    $view_footer = "Views/App/$view.php";
    require_once $view_footer;
}

//Muestra información formateada
function dep($data, $exit = 0)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    ($exit != 0) ? $format .= exit : '';
    return $format;
}
//Elimina exceso de espacios entre palabras
function strClean($strCadena)
{
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
    $string = trim($string); //Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); // Elimina las \ invertidas
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}
//Genera una contraseña de 10 caracteres
function passGenerator($length = 10)
{
    $pass = "";
    $longitudPass = $length;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena = strlen($cadena);

    for ($i = 1; $i <= $longitudPass; $i++) {
        $pos = rand(0, $longitudCadena - 1);
        $pass .= substr($cadena, $pos, 1);
    }
    return $pass;
}
//Genera un token
function token($cant = 10)
{
    $r1 = bin2hex(random_bytes($cant));
    $r2 = bin2hex(random_bytes($cant));
    $r3 = bin2hex(random_bytes($cant));
    $r4 = bin2hex(random_bytes($cant));
    $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
    return $token;
}
//Formato para valores monetarios
function formatMoney($cantidad)
{
    $cantidad = SMONEY . number_format($cantidad, 2, SPD, SPM);
    return $cantidad;
}

// Generador de números 
function generar_numeros($digitos = 8)
{
    $num = 0;
    $num = mt_rand(pow(10, $digitos - 1), pow(10, $digitos) - 1);
    return $num;
}

//Generador de letras
function generar_letras($strength = 16)
{
    $input = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

// url pero amigable
function urls_amigables($url)
{
    // Tranformamos todo a minusculas
    $url = strtolower($url);
    //Rememplazamos caracteres especiales latinos
    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
    $repl = array('a', 'e', 'i', 'o', 'u', 'n');
    $url = str_replace($find, $repl, $url);
    // Añadimos los guiones
    $find = array(' ', '&', '\r\n', '\n', '+');
    $url = str_replace($find, '-', $url);
    // Eliminamos y Reemplazamos demás caracteres especiales
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '-', '');
    $url = preg_replace($find, $repl, $url);
    return $url;
}

function enviarEmail($data, $template)
{
    // require 'vendor/phpmailer/phpmailer/src/Exception.php';
    // require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    // require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require_once __DIR__ . '/../Models/serverEmail.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $objEmail = new serverEmail();
    $msg = [];

    $dataEmail = $objEmail->leerConfig();
    if (!empty($dataEmail)) {
        $emailDestino = $data['email'];
        $asunto = $data['asunto'];
        $nombre = $data['nombre'];
        ob_start();
        require_once("Views/Email/" . $template . ".php");
        $mensaje = ob_get_clean();
        try {
            //Server settings
            // $mail->SMTPDebug = mostrar debug: 0 no mostrar: 1;
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            // $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->Host       = $dataEmail['em_host'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $dataEmail['em_usermail'];                     //SMTP username
            $mail->Password   = $dataEmail['em_pass'];                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $dataEmail['em_port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = "UTF-8";
            $mail->setLanguage('es', 'vendor/phpmailer/phpmailer/language/');      //To load the French version

            //Recipients
            $mail->setFrom($dataEmail['em_usermail'], NOMBRE_EMPRESA);
            $mail->addAddress($emailDestino, $nombre);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('leenh@leenhcraft.com', 'Information');
            $mail->addCC('leenh@leenhcraft.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments - archivos adjuntos
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content - mensaje
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $mensaje;
            $mail->AltBody = 'leenhcraft.com';
            $mail->charSet = "UTF-8";

            $mail->send();
            $msg['status'] = true;
            $msg['text'] = 'Mensaje enviado';
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $msg['status'] = false;
            $msg['text'] = "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }
    } else {
        $msg['status'] = false;
        $msg['text'] = "No se a configurado un servidor de email";
    }
    return $msg;
}

function menus()
{
    require_once "Models/NivelesModel.php";
    $nivel = new NivelesModel();
    $data = $nivel->menus($_SESSION['lnh_r']);
    return $data;
}

function submenus(int $idmenu)
{
    require_once "Models/NivelesModel.php";
    $nivel = new NivelesModel();
    $data = $nivel->submenus($idmenu);
    return $data;
}

function getPermisos($idmod)
{
    require_once 'Models/NivelesModel.php';
    $obj = new NivelesModel();
    return $obj->getPermisosMod(strtolower($idmod));
}

function pertenece($submen, $menu)
{
    require_once 'Models/NivelesModel.php';
    $obj = new NivelesModel();
    $request = $obj->pertenece($submen, $menu);
    return (!empty($request)) ? true : false;
}

function validar_clave($clave, &$error_clave)
{
    if (strlen($clave) < 6) {
        $error_clave = "La clave debe tener al menos 6 caracteres";
        return false;
    }
    if (strlen($clave) > 16) {
        $error_clave = "La clave no puede tener más de 16 caracteres";
        return false;
    }
    if (!preg_match('`[a-z]`', $clave)) {
        $error_clave = "La clave debe tener al menos una letra minúscula";
        return false;
    }
    if (!preg_match('`[A-Z]`', $clave)) {
        $error_clave = "La clave debe tener al menos una letra mayúscula";
        return false;
    }
    if (!preg_match('`[0-9]`', $clave)) {
        $error_clave = "La clave debe tener al menos un caracter numérico";
        return false;
    }
    if (!preg_match('/[@#$%&;*]/', $clave)) {
        $error_clave = "La clave debe tener al menos un caracter especial del tipo @, #, $, %, &, *";
        return false;
    }
    if (preg_match('/([0-9]+).*\1{2}/', $clave)) {
        $error_clave = "La clave no debe tener un número que se repita más de una vez.";
        return false;
    }
    // [@#$%&;*]
    $error_clave = "";
    return true;
}

function getModal($ruta, $data = "")
{
    $view_modal = "Views/App/Template/Modals/{$ruta}.php";
    require_once $view_modal;
}

function consultaDNI($dni)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        // CURLOPT_URL => "https://apiperu.dev/api/dni/$dni",
        // CURLOPT_URL => "https://api.conta.club/dni/$dni",
        CURLOPT_URL => "https://leenhcraft.com/api/dni/$dni",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzZXIiOiJsZWVuaGNyYWZ0LmNvbSIsInVzIjoibGVlbmhjcmFmdCIsImZlIjoiMjAyMi0wOS0xMCAwMTozMDozMCJ9.mQiXywYOF7wwRX5o5utodhtwbMqAY796mqY9a1lRSuAX_EzOk7eRLdCCgwjWNhfuCxH6zvZMFn-2H5ux5gQd9hJ57wGftG2tuqMF4r74pttSgf8TPB5PpY7loSjOpWuvmEHrc-Z4jiBIeV1skwLMoAGTvyl8jJzeFpVMDSQAUhoNxEcS7rYbgTRRgoX2smtGC4z0yiMN_0-PdWemis3dSyo-7AJYA176qqkaXdheUx2EOG_Tzp8yPKuC7kVGX-fmblD2gxzr3lTWNopYFljmuaTwLQa2-NvYYHc0N2ki4lqDF09oryarp6o9UDjZy4Nz6i3Naeme8WTmgMaQdPjXMTZUwxk1jx5nzz6FlEqInIwZDQUSr01rDp2NTj_5gKNHnsqwaxxDOp6Xg9hp_v6RS8chERZ9SzW9THw5PPwD12S9MWajg50SBJMHRh8In_pXgaBnp0r0o2KsS_6dbpvpqY7ok8upgIInbK7Ov-5J9EWM9V-U9iDzmrShfWTzSVmsq_xYYCNjNGH4cuZtp7kMg03XYEHpTqW2vmF8iQNMCCOdirfuHbFlE2kV9nvH-4WK9x6Ub1UoSFnJo8_wv7mRUCRRVi73xGO2RpoP7p__A1KoDu_QPibKYuyiU4d3ZQrCMGGOomCFjJ-0iOKD4Z33l0CwnzFUE-RkyLsQ7GiGP7s"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    return $response;
}


// Obtener nomnre de usuario app
function getName(int $id)
{
    require_once("Models/PermisosModel.php");
    $objPermisos = new PermisosModel();
    $arrPermisos = $objPermisos->bscUsu($id);
    if (ucfirst($arrPermisos['rol']) == 'Root') {
        $arrPermisos['rol'] = '<span class="badge bg-danger">' . $arrPermisos['rol'] . '</span>';
    } else if (ucfirst($arrPermisos['rol']) == 'Administrador') {
        $arrPermisos['rol'] = '<span class="badge bg-success">' . $arrPermisos['rol'] . '</span>';
    } else {
        $arrPermisos['rol'] = '<span class="badge bg-info">' . $arrPermisos['rol'] . '</span>';
    }
    return $arrPermisos;
}

//nombre de usuario web
function getName2($id2)
{
    require_once("Models/WebModel.php");
    $objPermisos = new WebModel();
    $id = (isset($_SESSION['pe_u'])) ? $_SESSION['pe_u'] : $id2;
    $arrPermisos = $objPermisos->usu($id);
    return $arrPermisos;
}

// function can_carrito()
// {
//     require_once 'Models/WebModel.php';
//     $objWeb = new WebModel();
//     $b = (isset($_SESSION['vi'])) ? $_SESSION['vi'] : 0;
//     $a = $objWeb->car_art($b);
//     return $a;
// }

function codigo_visita()
{
    date_default_timezone_set('America/Lima');
    require_once("Models/WebModel.php");
    $objWeb = new WebModel();
    $ip = '';
    $metod = isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD']  : 'none';
    $ip .= isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) ? ' IP: ' . $_SERVER['REMOTE_ADDR']  : '';
    $ip .= isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) ? ' IP: ' . $_SERVER['HTTP_CLIENT_IP'] : '';
    $ip .= isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? ' IP: ' . $_SERVER['HTTP_X_FORWARDED_FOR'] : '';
    $ip .= isset($_SERVER['HTTP_X_FORWARDED']) && !empty($_SERVER['HTTP_X_FORWARDED']) ? ' IP: ' . $_SERVER['HTTP_X_FORWARDED'] : '';
    $ip .= isset($_SERVER['HTTP_CF_CONNECTING_IP']) && !empty($_SERVER['HTTP_CF_CONNECTING_IP']) ? ' Dispositivo: ' . $_SERVER['HTTP_CF_CONNECTING_IP'] : '';
    $url = isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ? ': ' . $_SERVER['REQUEST_URI'] : ' $_SERVER[´REQUEST_URI´] No existe';
    $agente = isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT']) ? dispositivo($_SERVER['HTTP_USER_AGENT']) : 'No existe';
    if (!isset($_SESSION['vi'])) {
        $vi = generar_numeros(4);
        $_SESSION['vi'] = $vi;
        $_SESSION['visita'] = 'Visita_' . $_SESSION['vi'];
        $objWeb->rg_visita($_SESSION['vi'], $ip, $agente, $url, $metod);
    } else {
        $vi = $_SESSION['vi'];
        $response = $objWeb->chk_vi($vi);
        while (!empty($response)) {
            $vi = generar_numeros(4);
            $response = $objWeb->chk_vi($vi);
        }
        if (!empty($response)) {
            $_SESSION['vi'] = $vi;
            $_SESSION['visita'] = 'Visista_' . $_SESSION['vi'];
            $objWeb->rg_visita($_SESSION['vi'], $ip, $agente, $url, $metod);
        }
    }
    if (isset($_SESSION['login'])) {
        //Comprobamos si esta definida la sesión 'tiempo'.
        if (isset($_SESSION['tiempo'])) {

            //Tiempo en segundos para dar vida a la sesión.
            $inactivo = 1200; //5 min en este caso.

            //Calculamos tiempo de vida inactivo.
            $vida_session = time() - $_SESSION['tiempo'];

            //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
            if ($vida_session > $inactivo) {
                //Removemos sesión.
                session_unset();
                //Destruimos sesión.
                session_destroy();
                //Redirigimos pagina.
                header('location: ' . base_url());
                exit();
            }
        }
        $_SESSION['tiempo'] = time();
    }
    $objWeb->centinel($_SESSION['vi'], $ip, $agente, $url, $metod);
}

function dispositivo($param)
{
    $agenteDeUsuario = $param;
    $parseador = Parser::create();
    $resultado = $parseador->parse($agenteDeUsuario);
    $familiaNavegador = $resultado->ua->family; // Chrome, Firefox, Safari, Edge
    $navegador = $resultado->ua->toString();
    $dispositivo = $resultado->device->family;
    $familiaSistema = $resultado->os->family;
    $sistema = $resultado->os->toString();
    $completo = $resultado->toString();
    $return = 'Familia de navegador: ' . $familiaNavegador . ', Navegador: ' . $navegador . ', Dispositivo: ' . $dispositivo .
        ', Familia OS: ' . $familiaSistema . ', SO: ' . $sistema . ', Info completa: ' . $completo;
    return $return;
}

function addceros($string, $ceros = 4)
{
    $string = (string) $string;
    $longitud = strlen($string);
    if ($longitud < $ceros) {
        $ceros_faltantes = $ceros - $longitud;
        for ($i = 0; $i < $ceros_faltantes; $i++) {
            $string = '0' . $string;
        }
    }
    return $string;
}

// function compoArt($metodo, $data)
// {
//     require_once('Views/Web/Template/comArt.php');
//     if (!empty($data)) {


//         switch ($metodo) {
//             case 'card':
//                 $html = card($data);
//                 break;
//             case 'slider':
//                 $html = slider($data);
//                 break;
//             case 'card_home':
//                 $html = card_home($data);
//                 break;
//             case 'slider_car':
//                 $html = slider_carousel($data);
//                 break;
//             case 'card_pro':
//                 $html = card_pro($data);
//                 break;
//             default:
//                 $html = 'Sin metodo al que consultar';
//                 break;
//         }
//     } else {
//         $html = '<div class="w-100 text-center alert alert-info" role="alert">Lo sentimos mucho, pero no hay información disponible.</div>';
//     }
//     return $html;
// }

function paginador($data, $limite = 12, $pagina = 1)
{
    // dep([$data['count'], $limite]);
    if ($data['count'] > 0 && $data['count'] > $limite) {
        $totalPaginas = ceil($data['count'] / $limite);
        // dep(['total de pg' => $totalPaginas]);
        $active = '';
        $inicio = 1;
        $view = 3;
        $a = $b = $c = '';

        if ($totalPaginas > ($view + 2)) {
            $active = $pagina == $inicio ? 'class="active"' : '';
            $a .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $inicio . '">' . $inicio . '</a>';
            $active = '';
            if ($pagina == 1) { // si esta en la primera pagina
                for ($i = 2; $i <= $view + 1; $i++) {
                    $b .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $i . '">' . $i . '</a>';
                }
                $b .= '<a href="#" style="pointer-events: none">...</a>';
            } else {
                if ($pagina == $totalPaginas) { // si esta en la ultima pagina
                    if ($totalPaginas > $view) {
                        $b .= '<a href="#" style="pointer-events: none">...</a>';
                        for ($i = $totalPaginas - $view; $i < $totalPaginas; $i++) {
                            $b .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $i . '">' . $i . '</a>';
                        }
                    }
                } else { // si esta en una pagina intermedia
                    $atras = $pagina - $view;
                    $adelante = $pagina + $view;
                    if ($atras > $view && $pagina <= $totalPaginas) {
                        $b .= '<a href="#" style="pointer-events: none">...</a>';
                        for ($i = $atras; $i <= $pagina; $i++) {
                            $active = $pagina == $i ? 'class="active"' : '';
                            $b .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $i . '">' . $i . '</a>';
                        }
                        $active = '';
                    } else if ($pagina <= $totalPaginas) {
                        for ($i = $inicio + 1; $i <= $pagina; $i++) {
                            $active = $pagina == $i ? 'class="active"' : '';
                            $b .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $i . '">' . $i . '</a>';
                        }
                        $active = '';
                    }

                    if ($adelante < ($totalPaginas - $view)) {
                        for ($i = $pagina + 1; $i <= $adelante; $i++) {
                            $b .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $i . '">' . $i . '</a>';
                        }
                        $b .= '<a href="#" style="pointer-events: none">...</a>';
                    } else {
                        for ($i = $pagina + 1; $i <= $totalPaginas - 1; $i++) {
                            $b .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $i . '">' . $i . '</a>';
                        }
                    }
                    // dep([$atras, $pagina, $adelante]);
                }
            }
            $active = $pagina == $totalPaginas ? 'class="active"' : '';
            $c .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $totalPaginas . '">' . $totalPaginas . '</a>';
            $active = '';
        } else {
            for ($i = $inicio; $i <= $totalPaginas; $i++) {
                $active = $pagina == $i ? 'class="active"' : '';
                $b .= '<a ' . $active . ' href="' . base_url() . 'tienda/pagina/' . $i . '">' . $i . '</a>';
            }
        }
        $html = '
    <div class="product__pagination text-center mb-5">
        ' . $a . $b . $c . '
    </div>
    ';
    } else {
        $html = '';
    }
    return $html;
}

function urls()
{
    $url = !empty($_GET['url']) ? $_GET['url'] : 'web/web';
    $arrUrl = explode("/", $url);
    $controller = $arrUrl[0];
    $method = isset($arrUrl[1]) ? $arrUrl[1] : $arrUrl[0];
    $params = "";
    if (!empty($arrUrl[2])) {
        if ($arrUrl[2] != "") {
            for ($i = 2; $i < count($arrUrl); $i++) {
                $params .=  $arrUrl[$i] . ',';
            }
            $params = trim($params, ',');
        }
    }
    // $params = isset($arrUrl[2]) ? $arrUrl[2] : '';
    return ['controllers' => $controller, 'method' => $method, 'params' => $params];
}

function getTokenCsrf()
{
    if (isset($_SESSION['csrf'])) {
        unset($_SESSION['csrf']);
    }
    $token = token(5);
    $_SESSION['csrf'] = ['token' => $token, 'time' => time()];
    return $token;
}

function validarCrf($token = "")
{
    $return = ['status' => false, 'message' => 'Error de token'];
    if (isset($_SESSION['csrf']) && $_SESSION['csrf']['token'] === $token) {
        $inactivo = 300; //5 min en este caso.
        $vida_session = time() - $_SESSION['csrf']['time'];
        if ($vida_session > $inactivo) {
            unset($_SESSION['csrf']);
            $return = ['status' => false, 'message' => 'Token expirado'];
        } else {
            $return = ['status' => true, 'message' => 'Token valido'];
        }
    } else {
        $return = ['status' => false, 'message' => 'Token desconocido'];
    }
    return $return;
}
