<?php

namespace App\Models;

use Core\Model;

class ConnexionMod extends Model {
	public $errorMessage;

	public function connexion($login, $pwd) {
		$req = self::$db->prepare("SELECT password FROM users WHERE login = ?");
		$req->execute(array($login));
		$res = $req->fetch();

		if ($res === false) {
			$this->errorMessage = 'Mauvais login !';
		} elseif ($pwd !== $res["password"]) {
			$this->errorMessage = 'Mauvais password !';
		} else {
			// On ouvre la session
			session_start();
			// On enregistre le login en session
			$_SESSION['login'] = $login;
			// On redirige
			header('Location: /home?action=showListPosts');
			exit();
		}

	}
}
