<?php
class Errors extends Controllers
{
	public function __construct()
	{
		parent::__construct();
	}

	public function notFound()
	{
		$this->views->getView($this, "error");
	}

	public function errors()
	{
		$this->views->getView('Web', "error");
	}
}

$notFound = new Errors();
$notFound->notFound();
