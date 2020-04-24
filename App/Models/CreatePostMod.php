<?php

namespace App\Models;

use Core\Model;

class CreatePostMod extends Model {

	public function addPost($title, $content) {
		$req = self::$db->prepare("INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())");
		$affectedLines = $req->execute(array($title, $content));
		return $affectedLines;
	}
}