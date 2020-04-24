<?php

namespace App\Controllers;

class CreatePostCtr {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function createPost() {
		if ($_SESSION["login"] != "admin") {
			header("Location: /home?action=showListPosts");
			exit();
		}
	}

	public function addPost() {
		if ($_SESSION["login"] == "admin") {
			$affectedLines = $this->model->addPost($_POST["title"], $_POST["content"]);
			if ($affectedLines === false) {
				throw new \Exception("Impossible d'ajouter le billet !");
			}
		}
		else {
			header("Location: /home?action=showListPosts");
			exit();
		}
	}
}