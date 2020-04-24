<?php

namespace App\Views\Classes;

use Core\View;

class ConnexionView extends View {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function display() {
		$params = [
			'pageTitle' => 'Connexion',
			'errorMessage' => $this->model->errorMessage,
			'session' => $_SESSION,
			"active" => [
				"home" => false,
				"posts" => false,
				"createPost" => false,
				"inscription" => false,
				"connexion" => true
			]
		];
		echo self::$twig->render('connexion.twig', $params);
	}
}