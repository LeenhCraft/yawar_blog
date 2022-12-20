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
        if ($this->eslogan) {
            return [
                'eslogan' => [
                    'status' => $this->eslogan,
                    'content' => $this->model->sloganPrincipal()
                ],
            ];
        } else {
            return [];
        }
    }

    public $publicapost = true;
    public function publicapost()
    {
        if ($this->publicapost) {
            return [
                'publicapost' => [
                    'status' => $this->publicapost,
                    // 'content' => $this->other->getUser($_SESSION['lnh'])
                ],
            ];
        } else {
            return [];
        }
    }

    public $listaetiquetas = true;
    public function listaetiquetas()
    {
        if ($this->listaetiquetas) {
            return [
                'listaetiquetas' => [
                    'status' => $this->listaetiquetas,
                    'content' => $this->model->listTags()
                ],
            ];
        } else {
            return [];
        }
    }

    public $register = true;
    public function register()
    {
        if ($this->register) {
            return [
                'register' => [
                    'status' => $this->register,
                    'content' => $this->model->register()
                ]
            ];
        } else {
            return [];
        }
    }

    public $postprincipal = true;
    public function postprincipal()
    {
        if ($this->postprincipal) {
            return [
                'postprincipal' => [
                    'status' => $this->postprincipal,
                    'content' => $this->model->posts(1)
                ],
            ];
        } else {
            return [];
        }
    }

    public $postrandom = true;
    public function postrandom()
    {
        if ($this->postrandom) {
            return [
                'postrandom' => [
                    'status' => true,
                    'content' => $this->model->randoPost()
                ],
            ];
        } else {
            return [];
        }
    }

    public $postdestacados = true;
    public function postdestacados()
    {
        if ($this->postdestacados) {
            return [
                'postdestacados' => [
                    'status' => $this->postdestacados,
                    'content' => $this->model->postDesta()
                ],
            ];
        } else {
            return [];
        }
    }

    public $listaminipost = true;
    public function listaminipost()
    {
        if ($this->listaminipost) {
            return [
                'listaminipost' => [
                    'status' => $this->listaminipost,
                    'content' => $this->model->posts(2)
                ],
            ];
        } else {
            return [];
        }
    }

    public $listagaleria = true;
    public function listagaleria()
    {
        if ($this->listagaleria) {
            return [
                'listagaleria' => [
                    'status' => $this->listagaleria,
                    'content' => $this->model->galleries()
                ]
            ];
        } else {
            return [];
        }
    }

    public $menu = true;
    public function menu()
    {
        if ($this->menu) {
            return [
                'menu' => [
                    'status' => $this->menu,
                    'content' => $this->model->menus(),
                ],
            ];
        } else {
            return [];
        }
    }

    public $esloganfooter = true;
    public function esloganfooter()
    {
        if ($this->esloganfooter) {
            return [
                'esloganfooter' => [
                    'status' => $this->esloganfooter,
                    'content' => $this->model->sloganFooter(),
                ]
            ];
        } else {
            return [];
        }
    }

    public $linksfooter = true;
    public function linksfooter()
    {
        if ($this->linksfooter) {
            return [
                'linksfooter' => [
                    'status' => $this->linksfooter,
                    'content' => $this->model->linksFooter()
                ]
            ];
        } else {
            return [];
        }
    }
}
