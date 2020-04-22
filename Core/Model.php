<?php

namespace Core;

use PDO;
use App\Config;

class Model {
	public static $db = null;

	public static function dbConnect() {
		if (self::$db === null) {
			$dsn = 'pgsql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME;
			self::$db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
			// self::$db = new \PDO('pgsql:host=localhost;dbname=test', 'gverissi', 'gverissi');
		}
	}
}
