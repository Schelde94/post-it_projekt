<?php

function createUser($un, $pw){
	$pwhash = password_hash($pw, PASSWORD_DEFAULT);
	require('dbcon.php');
	
	$sql = 'INSERT INTO users (username, pwhash) VALUES (?, ?)';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('ss', $un, $pwhash);
	$stmt->execute();
	
	return $stmt->affected_rows;
}


function loginUser($un, $pw){
	require('dbcon.php');
	
	$sql = 'SELECT id, pwhash FROM users WHERE username=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($id, $pwhash);
	
	while ($stmt->fetch()){	}
	
	$loginValid = password_verify($pw,$pwhash);
	if ($loginValid){
		$_SESSION['uid'] = $id;
		$_SESSION['uname'] = $un;
	}
	return $loginValid;
}


function logoutUser(){
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	session_destroy();			
}

