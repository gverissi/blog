<?php

namespace App\Views\Classes;

use Core\View;

class HomeView extends View {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function display() {
		$params = [
			"pageTitle" => "Mon blog",
			"posts" => $this->model->posts,
			"session" => $_SESSION,
			"active" => [
				"home" => true,
				"posts" => false,
				"createPost" => false,
				"inscription" => false,
				"connexion" => false
			]
		];
		echo self::$twig->render("home.twig", $params);
	}
}