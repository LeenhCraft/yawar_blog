<?php
class CompWeb extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function components()
    {
        $data = [ //traer de la db
            'menu' => [
                'status' => true,
                'content' => $this->model->menus(),
            ],
            'eslogan' => [
                'status' => true,
                'content' => $this->model->sloganPrincipal()
            ],
            'listaetiquetas' => [
                'status' => true,
                'content' => $this->model->listTags()
            ],
            'postprincipal' => [
                'status' => true,
                // 'content' => $this->model->postPrin()
                'content' => $this->model->posts(1)
            ],
            'postrandom' => [
                'status' => true,
                'content' => $this->model->randoPost()
            ],
            'postdestacados' => [
                'status' => true,
                'content' => $this->model->postDesta()
            ],
            'listaminipost' => [
                'status' => true,
                'content' => $this->model->posts(2)
            ],
            'listagaleria' => [
                'status' => true,
                'content' => $this->model->galleries()
            ],
            'esloganfooter' => [
                'status' => true,
                'content' => $this->model->sloganFooter()
            ],
            'linksfooter' => [
                'status' => true,
                'content' => $this->model->linksFooter()
            ],
        ];
        return $data;
    }
}
