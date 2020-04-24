<?php

namespace App\Models;

use Core\Model;

class HomeMod extends Model {
	public $posts;

	public function getListPosts() {
		$req = self::$db->query(
			"SELECT id, title, content, to_char(creation_date, 'dd-mm-YYYY à HH24:MI:SS') AS creation_date_fr
			FROM posts ORDER BY creation_date DESC LIMIT 10");
		$this->posts = $req->fetchall();
	}

	public function deletePost($postId) {
		$req = self::$db->prepare('DELETE FROM posts WHERE id = ?');
		$affectedLines = $req->execute(array($postId));
		return $affectedLines;
	}
}