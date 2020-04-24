<?php

namespace App\Controllers;

class EditPostCtr {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function editPost() {
		if ($_SESSION["login"] == "admin") {
			$this->model->post = [
				"id" => $_GET["postId"],
				"title" => $_GET["title"],
				"content" => $_GET["content"]
			];
		}
		else {
			header("Location: /home?action=showListPosts");
			exit();
		}
	}

	public function deletePost() {
		if ($_SESSION["login"] == "admin") {
			$affectedLines = $this->model->deletePost($_GET['postId']);
			if ($affectedLines === false) {
				throw new \Exception('Impossible de supprimer le post !');
			}
			else {
				header("Location: /home?action=showListPosts");
				exit();
			}
		}
		else {
			header("Location: /home?action=showListPosts");
			exit();
		}
	}

	public function updatePost() {
		if ($_SESSION["login"] == "admin") {
			$affectedLines = $this->model->updatePost($_GET["postId"], $_POST["title"], $_POST["content"]);
			if ($affectedLines === false) {
				throw new \Exception("Impossible de modifier le billet !");
			}
			else {
				header("Location: /post?action=showPost&postId={$_GET["postId"]}");
				exit();
			}
		}
		else {
			header("Location: /post?action=showPost&postId={$_GET["postId"]}");
			exit();
		}
	}
}