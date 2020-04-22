<?php

namespace Core;

class Router {
	private $triad = array();
	private $actions = array();
	private $view;
	private $controller;

	public function add($route, $actions, $triad) {
		$this->triad[$route] = $triad;
		$this->actions[$route] = $actions;
	}

	public function dispatch($route, $action) {
		//Fetch the names of each component from the triad
		$modelName = 'App\\Models\\' . $this->triad[$route]['model'];
		$viewName = 'App\\Views\\Classes\\' . $this->triad[$route]['view'];
		$controllerName = 'App\\Controllers\\' . $this->triad[$route]['controller'];
		//Instantiate each component
		$model = new $modelName;
		$this->view = new $viewName($model);
		$this->controller = new $controllerName($model);
		//Run the controller action
		Model::dbConnect();
		// $action = $this->actions[$route];
		$this->controller->$action();
	}

	public function displayView() {
		//Finally a method for outputting the data from the view
		View::initTwig();
		$this->view->display();
	}
}