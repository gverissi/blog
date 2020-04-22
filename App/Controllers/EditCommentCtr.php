<?php

namespace App\Controllers;

class EditCommentCtr {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function editComment() {
		$this->model->post = ["id" => $_GET["postId"]];
		$this->model->getComment($_GET["commentId"]);
	}

	public function updateComment() {
		$affectedLines = $this->model->updateComment($_GET["commentId"], $_POST["comment"]);
		if ($affectedLines === false) {
			throw new \Exception("Impossible de modifier le commentaire !");
		}
		else {
			header("Location: /post?action=showPost&id={$_GET["postId"]}");
		}
	}

	public function deleteComment() {
		$affectedLines = $this->model->deleteComment($_GET["commentId"]);
		if ($affectedLines === false) {
			throw new \Exception("Impossible de supprimer le commentaire !");
		}
		else {
			header("Location: /post?action=showPost&id={$_GET["postId"]}");
		}
	}
}