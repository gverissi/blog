<?php

namespace App\Controllers;

class ConnexionCtr {
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function formConnexion() {
	}

	public function connexion() {
		$this->model->errorMessage = "";
		if (!empty($_POST["login"]) && !empty($_POST["pwd"])) {
			$this->model->connexion($_POST["login"], $_POST["pwd"]);
		} else {
			$this->model->errorMessage = "Veuillez inscrire vos identifiants svp !";
		}
	}

	public function logout() {
		$_SESSION = array();
		session_destroy();
		unset($_SESSION);
		header("Location: /home?action=showListPosts");
		exit();
	}
}