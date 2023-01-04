<?php
class FilesClass extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function existe($ruta)
    {
        if (file_exists($ruta)) {
            return true;
        } else {
            return false;
        }
    }

    public function esDir($ruta)
    {
        if (is_dir($ruta)) {
            return true;
        } else {
            return false;
        }
    }

    public function crearDir($ruta)
    {
        if (!file_exists($ruta)) {
            return mkdir($ruta, 0777, true);
        } else {
            return false;
        }
    }

    public function eliminarDir($ruta)
    {
        if (file_exists($ruta)) {
            return rmdir($ruta);
        } else {
            return false;
        }
    }
}
