<?php

namespace App\Models;

class HomeMod extends \Core\Model {
	public $posts;

	public function getListPosts() {
		$req = self::$db->query("SELECT id, title, content, to_char(creation_date, 'dd-mm-YYYY à HH24:MI:SS') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 10");
		$this->posts = $req->fetchall();
	}
}