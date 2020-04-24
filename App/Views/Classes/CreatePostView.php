<?php

namespace App\Views\Classes;

use Core\View;

class CreatePostView extends View {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function display() {
		$params = [
			'pageTitle' => 'Create post',
			'session' => $_SESSION,
			"active" => [
				"home" => false,
				"posts" => false,
				"createPost" => true,
				"inscription" => false,
				"connexion" => false
			]
		];
		echo self::$twig->render('create_post.twig', $params);
	}
}