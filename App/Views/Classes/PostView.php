<?php

namespace App\Views\Classes;

use Core\View;

class PostView extends View {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function display() {
		$params = [
			'pageTitle' => 'Post',
			'post' => $this->model->post,
			'comments' => $this->model->comments,
			'session' => $_SESSION
		];
		echo self::$twig->render('post.twig', $params);
	}
}