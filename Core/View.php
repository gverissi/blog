<?php

namespace Core;

class View {
	public static $twig = null;

	public static function initTwig() {
		if (self::$twig === null) {
			$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views/Twigs');
			self::$twig = new \Twig\Environment($loader);
		}
	}
}