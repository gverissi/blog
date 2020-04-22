<?php

namespace App\Controllers;

class AdminHomeCtr extends HomeCtr {

	public function deletePost() {
		$affectedLines = $this->model->deletePost($_POST['post_id']);
		if ($affectedLines === false) {
			throw new \Exception('Impossible de supprimer le post !');
		}
		else {
			$this->showListPosts();
		}
	}
}