<?php

use App\Config;
use Core\Model;

require dirname(__DIR__) . '/vendor/autoload.php';


// CONNECT
// =======
$host		= "host = " . Config::DB_HOST;
$port		= "port = 5432";
$dbname		= "dbname = " . Config::DB_NAME;
$user		= "user = " . Config::DB_USER;
$password	= "password = " . Config::DB_PASSWORD;

$db = pg_connect("$host $port $dbname $user $password");
if (!$db) echo "Error : Unable to open database\n";
else echo "Database opened successfully\n";
// ============================================================================


// DROP
// ====
$req = "DROP TABLE IF EXISTS comments";
$res = pg_query($db, $req);
if (!$res) echo pg_last_error($db);
else echo "Table comments dropped successfully\n";

$req = "DROP TABLE IF EXISTS posts";
$res = pg_query($db, $req);
if (!$res) echo pg_last_error($db);
else echo "Table posts dropped successfully\n";

$req = "DROP TABLE IF EXISTS users";
$res = pg_query($db, $req);
if (!$res) echo pg_last_error($db);
else echo "Table users dropped successfully\n";
// ============================================================================


// CREATE
// ======
$req = <<<EOF
CREATE TABLE users (
	id serial NOT NULL,
	login varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
    user_date timestamp NOT NULL,
	CONSTRAINT pk_usr PRIMARY KEY (id)
);
EOF;
$res = pg_query($db, $req);
if (!$res) echo pg_last_error($db);
else echo "Table users created successfully\n";

$req = <<<EOF
CREATE TABLE posts (
	id serial NOT NULL,
	title varchar(255) NOT NULL,
	content text NOT NULL,
	creation_date timestamp NOT NULL,
	CONSTRAINT pk_pos PRIMARY KEY (id)
);
EOF;
$res = pg_query($db, $req);
if (!$res) echo pg_last_error($db);
else echo "Table posts created successfully\n";

$req = <<<EOF
CREATE TABLE comments (
    id serial NOT NULL,
    post_id int NOT NULL,
    user_id int NOT NULL,
    comment text NOT NULL,
    comment_date timestamp NOT NULL,
	CONSTRAINT pk_com PRIMARY KEY (id),
	FOREIGN KEY(post_id) REFERENCES posts(id) ON DELETE CASCADE,
	FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
EOF;
$res = pg_query($db, $req);
if (!$res) echo pg_last_error($db);
else echo "Table comments created successfully\n";
// ============================================================================

pg_close($db);
Model::dbConnect();
$db = Model::$db;

// MIGRATE
// =======
$faker = Faker\Factory::create('fr_FR'); // create a French faker

// USERS
// -----
$nbUsers = 100;
$datas = [];
$datas[0] = ["admin", "admin"];
for ($i = 1 ; $i <= $nbUsers ; $i++) {
	$login = $faker->unique()->firstName;
	$password = "pwd";
	$datas[$i] = [$login, $password];
}
$req = $db->prepare("INSERT INTO users(login, password, user_date) VALUES(?, ?, NOW())");
try {
	$db->beginTransaction();
	foreach ($datas as $row) {
		$res = $req->execute($row);
		if (!$res) exit("Errrrrrrrrrrrrrror Records in table users\n");
	}
	$db->commit();
	echo "Records created successfully in table users\n";
} catch (Exception $e) {
	throw $e;
}
// ----------------------------------------------------------------------------

// POSTS
// -----
$nbPosts = 20;
$datas = [];
for ($i = 1 ; $i <= $nbPosts ; $i++) {
	$title = $faker->realText(40);
	$content = $faker->realText(500);
	$datas[$i] = [$title, $content];
}
$req = $db->prepare("INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())");
try {
	$db->beginTransaction();
	foreach ($datas as $row) {
		$res = $req->execute($row);
		if (!$res) exit("Errrrrrrrrrrrrrror Records in table posts\n");
	}
	$db->commit();
	echo "Records created successfully in table posts\n";
} catch (Exception $e) {
	$db->rollback();
	throw $e;
}
// ----------------------------------------------------------------------------

// COMMENTS
// --------
$datas = [];
$k = 0;
for ($i = 1 ; $i <= $nbPosts ; $i++) {
	for ($j = 1 ; $j <= mt_rand(2, 10) ; $j++) {
		$k++;
		$user_id = mt_rand(1, $nbUsers);
		$comment = $faker->realText(100);
		$datas[$k] = [$i, $user_id, $comment];
	}
}
$req = $db->prepare("INSERT INTO comments(post_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())");
try {
	$db->beginTransaction();
	foreach ($datas as $row) {
		$res = $req->execute($row);
		if (!$res) exit("Errrrrrrrrrrrrrror Records in table comments\n");
	}
	$db->commit();
	echo "Records created successfully in table comments\n";
} catch (Exception $e) {
	$db->rollback();
	throw $e;
}
// ----------------------------------------------------------------------------

// ============================================================================
