<?php

namespace App\Views\Classes;

class AdminHomeView extends \Core\View {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function display() {
		$params = [
			'pageTitle' => 'Mon blog',
			'posts' => $this->model->posts
		];
		echo self::$twig->render('admin_home.twig', $params);
	}
}