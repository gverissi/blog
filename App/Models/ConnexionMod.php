<?php

namespace App\Models;

use Core\Model;

class ConnexionMod extends Model {
	public $errorMessage;

	public function connexion($login, $password) {
		$req = self::$db->prepare("SELECT id, password FROM users WHERE login = ?");
		$req->execute(array($login));
		$res = $req->fetch();

		if ($res === false) {
			$this->errorMessage = "Mauvais login !";
		} elseif ($password !== $res["password"]) {
			$this->errorMessage = "Mauvais password !";
		} else {
			// On ouvre la session
			// session_start();
			// On enregistre le login en session
			$_SESSION["login"] = $login;
			$_SESSION["userId"] = $res["id"];
			// On redirige
			header("Location: /home?action=showListPosts");
			exit();
		}

	}
}
