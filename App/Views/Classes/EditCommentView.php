<?php

namespace App\Views\Classes;

class EditCommentView extends \Core\View {
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