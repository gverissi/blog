<?php

namespace App\Models;

use Core\Model;

class EditCommentMod extends Model {
	public $post;
	public $comment;

	public function updateComment($commentId, $comment) {
		$req = self::$db->prepare("UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?");
		$affectedLines = $req->execute(array($comment, $commentId));
		return $affectedLines;
	}

	public function deleteComment($commentId) {
		$req = self::$db->prepare('DELETE FROM comments WHERE id = ?');
		$affectedLines = $req->execute(array($commentId));
		return $affectedLines;
	}
}