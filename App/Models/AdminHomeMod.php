<?php

namespace App\Models;

class AdminHomeMod extends HomeMod {

	public function deletePost($postId) {
		$req = self::$db->prepare('DELETE FROM posts WHERE id = ?');
		$affectedLines = $req->execute(array($postId));
		return $affectedLines;
	}
}