<?php

namespace App\Views\Classes;

use Core\View;

class EditCommentView extends View {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function display() {
		$params = [
			'pageTitle' => 'Edit comment',
			'post' => $this->model->post,
			'comment' => $this->model->comment
		];
		echo self::$twig->render('edit_comment.twig', $params);
	}
}