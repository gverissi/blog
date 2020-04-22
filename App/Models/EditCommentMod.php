<?php

namespace App\Models;

class EditCommentMod extends \Core\Model {
	public $post;
	public $comment;

	public function getComment($commentId) {
		$req = self::$db->prepare("SELECT id, author, comment, to_char(comment_date, 'dd-mm-YYYY à HH24:MM:SS') AS comment_date_fr FROM comments WHERE id = ?");
		$req->execute(array($commentId));
		$this->comment = $req->fetch();
	}

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