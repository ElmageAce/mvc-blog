<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/mvcblog/core/init.php';

use Elmage\libs\Input;

use DI\ContainerBuilder;
use function DI\create;

try {

	$url = Input::get('url');

	$controller = ($url === false) ? ['Index'] : explode('/', rtrim(filter_var($url, FILTER_SANITIZE_URL), '/'));

	$controllerClass = ucfirst($controller[0]);

	$file = CTRL_PATH . $controllerClass . '.php';

	if (!file_exists($file)) {
		//throw exception
		throw new \Exception("Invalid link specified");

	}

	$container = new DI\Container();

	$pageController = $container->get('Elmage\controllers\\' . $controllerClass);
	
	$app = new Elmage\libs\Bootstrap($pageController);

	$app->loadController($controller);

	$app->displayPage();

} catch (Exception $e) {
	
	echo $e->getMessage();

}


?>