<?php

namespace App\Controllers;

class HomeCtr {
	protected $model;

	public function __construct($model) {
		$this->model = $model;
	}

	public function showListPosts() {
		$this->model->getListPosts();
	}
}