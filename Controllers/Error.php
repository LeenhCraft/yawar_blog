<?php
class Errors extends Controllers
{
	public function __construct()
	{
		parent::__construct();
	}

	public function notFound()
	{
		parent::otra_clase('Clases', 'CompWeb');
		$data['titulo_web'] = "Yawar.:404";
		parent::otro('CompWeb');
		$data['componentes'] = $this->oClass->principal();
		$data['postrandom'] = $this->other->randoPost(3);
		// dep($data,1);
		http_response_code(404);
		$this->views->getView($this, "Index", $data);
	}

	public function notAccess()
	{
		parent::otra_clase('Clases', 'CompWeb');
		$data['titulo_web'] = "Yawar.:404";
		parent::otro('CompWeb');
		$data['componentes'] = $this->oClass->principal();
		$data['postrandom'] = $this->other->randoPost(3);
		// dep($data,1);
		$this->views->getView($this, "403", $data);
	}
}

// $notFound = new Errors();
// $notFound->notFound();
