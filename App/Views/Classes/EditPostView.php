<?php

namespace App\Views\Classes;

use Core\View;

class EditPostView extends View {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function display() {
		$params = [
			'pageTitle' => 'Edit post',
			'post' => $this->model->post,
			'session' => $_SESSION,
			"active" => [
				"home" => false,
				"posts" => false,
				"createPost" => false,
				"inscription" => false,
				"connexion" => false
			]
		];
		echo self::$twig->render('edit_post.twig', $params);
	}
}