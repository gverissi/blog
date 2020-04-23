<?php

session_start();

require dirname(__DIR__) . '/vendor/autoload.php';

$router = new Core\Router();

// Add the route, actions and triad
// ================================
$route = '/home';
$actions = ['showListPosts'];
$triad = ['model' => 'HomeMod', 'view' => 'HomeView', 'controller' => 'HomeCtr'];
$router->add($route, $actions, $triad);

$route = '/post';
$actions = ['showPost', 'addComment'];
$triad = ['model' => 'PostMod', 'view' => 'PostView', 'controller' => 'PostCtr'];
$router->add($route, $actions, $triad);

$route = '/admin/home';
$actions = ['showListPosts', 'deletePost'];
$triad = ['model' => 'AdminHomeMod', 'view' => 'AdminHomeView', 'controller' => 'AdminHomeCtr'];
$router->add($route, $actions, $triad);

$route = '/connexion';
$actions = ['formConnexion', 'connexion'];
$triad = ['model' => 'ConnexionMod', 'view' => 'ConnexionView', 'controller' => 'ConnexionCtr'];
$router->add($route, $actions, $triad);

$route = '/edit';
$actions = ['editComment'];
$triad = ['model' => 'EditCommentMod', 'view' => 'EditCommentView', 'controller' => 'EditCommentCtr'];
$router->add($route, $actions, $triad);
// ================================================================================================

if (isset($_SERVER['PATH_INFO'])) {
	$route = $_SERVER['PATH_INFO'];
	$action = $_GET['action'];
}
else {
	$route = '/home';
	$action = 'showListPosts';
}
$router->dispatch($route, $action);
$router->displayView();
