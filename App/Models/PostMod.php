<?php

namespace App\Models;

session_start();

class PostMod extends \Core\Model {
	public $post;
	public $comments;

	public function getPost($postId) {
		$req = self::$db->prepare("SELECT id, title, content, to_char(creation_date, 'dd-mm-YYYY à HH24:MM:SS') AS creation_date_fr FROM posts WHERE id = ?");
		$req->execute(array($postId));
		$this->post = $req->fetch();
	}

	public function getComments($postId) {
		// $req = self::$db->prepare("SELECT id, author, comment, to_char(comment_date, 'dd-mm-YYYY à HH24:MM:SS') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC");
		$req = self::$db->prepare(
			"SELECT com.id, usr.login AS author, com.comment, to_char(com.comment_date, 'dd-mm-YYYY à HH24:MM:SS') AS comment_date_fr
			FROM comments AS com
			INNER JOIN users AS usr
			ON com.author = usr.id
			WHERE post_id = ? ORDER BY comment_date DESC"
		);
		$req->execute(array($postId));
		$this->comments = $req->fetchall();
	}

	public function addComment($postId, $author, $comment) {
		$req = self::$db->prepare("INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())");
		$affectedLines = $req->execute(array($postId, $author, $comment));
		return $affectedLines;
	}
}