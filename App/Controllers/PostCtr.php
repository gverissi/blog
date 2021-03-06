<?php

namespace App\Controllers;

// session_start();

class PostCtr {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function showPost() {
		$this->model->getPost($_GET["postId"]);
		$this->model->getComments($_GET["postId"]);
	}

	public function addComment() {
		$affectedLines = $this->model->addComment($_GET["postId"], $_SESSION["userId"], $_POST["comment"]);
		if ($affectedLines === false) {
			throw new \Exception("Impossible d'ajouter le commentaire !");
		}
		else {
			$this->showPost();
		}
	}
}