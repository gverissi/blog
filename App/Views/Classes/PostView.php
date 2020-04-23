<?php

namespace App\Views\Classes;

// session_start();

class PostView extends \Core\View {
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