<?php
require_once __DIR__ . '/../../Controllers/Error.php';
$objError = new Errors();
if (file_exists("Controllers/sys.php")) {
	require_once("Controllers/sys.php");
	$bp = new Sys();
} else {
	// require_once("Controllers/Error.php");
	$objError->notFound();
}
$controller = ucwords($controller);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$url_excluida = ['Sys'];
	for ($i = 0; $i <  count($url_excluida); $i++) {
		if ($controller === $url_excluida[$i]) {
			$controller = 'Error';
			$method = 'notFound';
		}
	}
}
$controllerFile = "Controllers/" . $controller . ".php";

if (file_exists($controllerFile)) {
	require_once($controllerFile);
	$controller = new $controller();
	if (method_exists($controller, $method)) {
		$controller->{$method}($params);
	} else {
		// require_once("Controllers/Error.php");
		$objError->notFound();
	}
} else {
	// require_once("Controllers/Error.php");
	$objError->notFound();
}
