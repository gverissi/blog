<?php

namespace App\Models;

use Core\Model;

class EditPostMod extends Model {
	public $post;

	public function updatePost($postId, $title, $content) {
		$req = self::$db->prepare("UPDATE posts SET title = ?, content = ?, creation_date = NOW() WHERE id = ?");
		$affectedLines = $req->execute(array($title, $content, $postId));
		return $affectedLines;
	}

	public function deletePost($postId) {
		$req = self::$db->prepare('DELETE FROM posts WHERE id = ?');
		$affectedLines = $req->execute(array($postId));
		return $affectedLines;
	}
}