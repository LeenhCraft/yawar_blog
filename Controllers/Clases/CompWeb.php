<?php
class CompWeb extends Controllers
{

    public function __construct()
    {
        parent::__construct();
    }

    public function compweb($methods)
    {
        $return = [];
        foreach ($methods as $method) {
            if (method_exists($this, $method)) {
                $return  = array_merge($return, $this->$method());
            }
        }
        return $return;
    }

    public function body()
    {
        // parent::otro('web');
        // $data = [ //traer de la db
        //     'eslogan' => [
        //         'status' => true,
        //         'content' => $this->model->sloganPrincipal()
        //     ],
        //     'publicapost' => [
        //         'status' => true,
        //         // 'content' => $this->other->getUser($_SESSION['lnh'])
        //     ],
        //     'listaetiquetas' => [
        //         'status' => true,
        //         'content' => $this->model->listTags()
        //     ],
        //     'postprincipal' => [
        //         'status' => true,
        //         // 'content' => $this->model->postPrin()
        //         'content' => $this->model->posts(1)
        //     ],
        //     'postrandom' => [
        //         'status' => true,
        //         'content' => $this->model->randoPost()
        //     ],
        //     'postdestacados' => [
        //         'status' => true,
        //         'content' => $this->model->postDesta()
        //     ],
        //     'listaminipost' => [
        //         'status' => true,
        //         'content' => $this->model->posts(2)
        //     ],
        //     'listagaleria' => [
        //         'status' => true,
        //         'content' => $this->model->galleries()
        //     ]
        // ];
        // return $data;
        return array_merge(
            $this->eslogan(),
            $this->publicapost(),
            $this->listaetiquetas(),
            $this->postprincipal(),
            $this->postrandom(),
            $this->postdestacados(),
            $this->listaminipost(),
            $this->listagaleria(),
        );
    }

    public function principal()
    {
        // $data = [ //traer de la db
        //     'menu' => [
        //         'status' => true,
        //         'content' => $this->model->menus(),
        //     ],
        //     'esloganfooter' => [
        //         'status' => true,
        //         'content' => $this->model->sloganFooter()
        //     ],
        //     'linksfooter' => [
        //         'status' => true,
        //         'content' => $this->model->linksFooter()
        //     ],
        // ];
        // return $data;
        return array_merge(
            $this->menu(),
            $this->esloganfooter(),
            $this->linksfooter(),
        );
    }

    public $eslogan = true;
    public function eslogan()
    {
        return [
            'eslogan' => [
                'status' => $this->eslogan,
                'content' => $this->model->sloganPrincipal()
            ],
        ];
    }

    public $publicapost = true;
    public function publicapost()
    {
        return [
            'publicapost' => [
                'status' => $this->publicapost,
                // 'content' => $this->other->getUser($_SESSION['lnh'])
            ],
        ];
    }

    public $listaetiquetas = true;
    public function listaetiquetas()
    {
        return [
            'listaetiquetas' => [
                'status' => $this->listaetiquetas,
                'content' => $this->model->listTags()
            ],
        ];
    }

    public $postprincipal = true;
    public function postprincipal()
    {
        return [
            'postprincipal' => [
                'status' => $this->postprincipal,
                'content' => $this->model->posts(1)
            ],
        ];
    }

    public $postrandom = true;
    public function postrandom()
    {
        return [
            'postrandom' => [
                'status' => true,
                'content' => $this->model->randoPost()
            ],
        ];
    }

    public $postdestacados = true;
    public function postdestacados()
    {
        return [
            'postdestacados' => [
                'status' => $this->postdestacados,
                'content' => $this->model->postDesta()
            ],
        ];
    }

    public $listaminipost = true;
    public function listaminipost()
    {
        return [
            'listaminipost' => [
                'status' => $this->listaminipost,
                'content' => $this->model->posts(2)
            ],
        ];
    }

    public $listagaleria = true;
    public function listagaleria()
    {
        return [
            'listagaleria' => [
                'status' => $this->listagaleria,
                'content' => $this->model->galleries()
            ]
        ];
    }

    public $menu = true;
    public function menu()
    {
        return [
            'menu' => [
                'status' => $this->menu,
                'content' => $this->model->menus(),
            ],
        ];
    }

    public $esloganfooter = true;
    public function esloganfooter()
    {
        return [
            'esloganfooter' => [
                'status' => $this->esloganfooter,
                'content' => $this->model->sloganFooter(),
            ]
        ];
    }

    public $linksfooter = true;
    public function linksfooter()
    {
        return [
            'linksfooter' => [
                'status' => $this->linksfooter,
                'content' => $this->model->linksFooter()
            ]
        ];
    }
}
