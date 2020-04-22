<?php

namespace App\Controllers;

session_start();

class PostCtr {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function showPost() {
		$this->model->getPost($_GET['id']);
		$this->model->getComments($_GET['id']);
	}

	public function postComment() {
		$affectedLines = $this->model->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
		if ($affectedLines === false) {
			throw new \Exception('Impossible d\'ajouter le commentaire !');
		}
		else {
			$this->showPost();
		}
	}
}