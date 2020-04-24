<?php

namespace App\Models;

use Core\Model;

class PostMod extends Model {
	public $post;
	public $comments;

	public function getPost($postId) {
		$req = self::$db->prepare("SELECT id, title, content, to_char(creation_date, 'dd-mm-YYYY à HH24:MI:SS') AS creation_date_fr FROM posts WHERE id = ?");
		$req->execute(array($postId));
		$this->post = $req->fetch();
	}

	public function getComments($postId) {
		$req = self::$db->prepare(
			"SELECT com.id, usr.login, com.comment, to_char(com.comment_date, 'dd-mm-YYYY à HH24:MI:SS') AS comment_date_fr
			FROM comments AS com
			INNER JOIN users AS usr
			ON com.user_id = usr.id
			WHERE post_id = ? ORDER BY com.comment_date DESC"
		);
		$req->execute(array($postId));
		$this->comments = $req->fetchall();
	}

	public function addComment($postId, $userId, $comment) {
		$req = self::$db->prepare("INSERT INTO comments(post_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())");
		$affectedLines = $req->execute(array($postId, $userId, $comment));
		return $affectedLines;
	}
}