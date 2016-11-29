<?php

class Route
{
	static function start()
	{
		$controller_name = 'Main';
		$action_name = 'index';

		// delete pagination code
		$pattern = "/\?page=[0-9]*/";
		$replacement = '';
		$uri = preg_replace($pattern, $replacement, $_SERVER['REQUEST_URI']);

		$routes = explode('/', $uri);

		// controller name
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// action name
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// adding prefixes
		$model_name = 'Model_' . $controller_name;
		$controller_name = $controller_name . 'Controller';
		$action_name = 'action' . $action_name;

		// including model
		$model_file = strtolower($model_name) . '.php';
		$model_path = "app/models/" . $model_file;
		if(file_exists($model_path))
		{
			include "app/models/" . $model_file;
		}

		// including controller
		$controller_file = strtolower($controller_name) . '.php';
		$controller_path = "app/controllers/" . $controller_file;
		// var_dump($controller_path);die;
		if(file_exists($controller_path))
		{
			include "app/controllers/" . $controller_file;
		}
		else
		{
			Route::page404();
		}
		
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			$controller->$action();
		}
		else
		{
			Route::page404();
		}
	
	}
	
	function page404()
	{
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:' . $host . '404');
    }
}