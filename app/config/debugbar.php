<?php

$debugbar = (isset($_GET['debugbar']) ? $_GET['debugbar'] : (isset($_COOKIE['debugbar']) ? $_COOKIE['debugbar'] : 0));
if ($debugbar == 1) {
	setcookie('debugbar', 1, 0, '/');
} elseif (!empty($_COOKIE['debugbar'])) {
	setcookie('debugbar', 0, -1, '/');
}
// show/unshow debugbar
defined('DEBUGBAR') or define('DEBUGBAR',$debugbar);
