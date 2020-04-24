<?php

namespace App\Controllers;

class EditCommentCtr {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function editComment() {
		// A faire secu editComment
		if (($_GET["login"] == $_SESSION["login"]) || ($_SESSION["login"] == "admin")) {
			$this->model->post = ["id" => $_GET["postId"]];
			$this->model->comment = [
				"id" => $_GET["commentId"],
				"comment" => $_GET["comment"]
			];
		}
		else {
			header("Location: /home?action=showListPosts");
			exit();
		}
	}

	public function updateComment() {
		$affectedLines = $this->model->updateComment($_GET["commentId"], $_POST["comment"]);
		if ($affectedLines === false) {
			throw new \Exception("Impossible de modifier le commentaire !");
		}
		else {
			header("Location: /post?action=showPost&postId={$_GET["postId"]}");
			exit();
		}
	}

	public function deleteComment() {
		$affectedLines = $this->model->deleteComment($_GET["commentId"]);
		if ($affectedLines === false) {
			throw new \Exception("Impossible de supprimer le commentaire !");
		}
		else {
			header("Location: /post?action=showPost&postId={$_GET["postId"]}");
			exit();
		}
	}
}