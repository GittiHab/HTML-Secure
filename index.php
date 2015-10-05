<?php
	define('SQLITE', './users.sqlite');
	define('MAX_TRIES', 10);
	define('ROOT_DIR', '');
	session_start();
	if (file_exists('./.lockdown')) {
		unset($_SESSION['auth']);
	} elseif (!file_exists(SQLITE)) {
		// In case this is the setup call
		$sql = new SQLite3(SQLITE);
		// Insert log table
		$sql->exec('CREATE  TABLE  IF NOT EXISTS "main"."log" ("ID" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , "user" INTEGER NOT NULL , "time" DATETIME NOT NULL )');
		// Insert users table
		$sql->exec('CREATE  TABLE  IF NOT EXISTS "main"."users" ("ID" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , "name" VARCHAR NOT NULL  UNIQUE , "password" VARCHAR NOT NULL )');
	}
	if (isset($_POST['login_field']) && !empty($_POST['login_field']) && isset($_POST['password_field']) && !empty($_POST['password_field'])) {
		$sql = new SQLite3(SQLITE);		
		
		$count = (file_exists('./.login_count'))? file_get_contents('./.login_count'): 0;
		if (file_exists('./.lockdown')) {
			echo 'locked';
		} else {
			$users = $sql->query('SELECT ID, password FROM users WHERE name = "'.$sql->escapeString(strtolower($_POST['login_field'])).'"');

			if($users) {
				$user = $users->fetchArray(SQLITE3_NUM);
				if ($_POST['password_field'] == $user[1]) {
					$_SESSION['auth'] = 1;
					echo 'success';
					$sql->exec('INSERT INTO log (user, time) VALUES ("'.$user[0].'", "'.$sql->escapeString(date('d-m-Y H:i')).'")');
					exit();
				}
			}
			
			echo 'failed';
			$count++;
			if ($count <= MAX_TRIES) {
				file_put_contents('./.login_count', $count);
			} else {
				file_put_contents('./.lockdown', "\n");
			}
		}
	} elseif (isset($_SESSION['auth']) && $_SESSION['auth'] === 1) { // authorized
		$start = strlen(ROOT_DIR);
		$end = strpos($_SERVER['REQUEST_URI'], '?');
		$end = ($end !== false)? $end: strlen($_SERVER['REQUEST_URI']);
		$uri = substr($_SERVER['REQUEST_URI'], $start, $end);
		
		$file = './'.$uri;
		if ($uri === '/index.php') {
			unset($_SESSION['auth']);
			header('Location: '.ROOT_DIR.'/');
			exit;
		}
		if (pathinfo($file, PATHINFO_EXTENSION) !== 'html' && is_dir($file)) {
			$file .= (substr($file, -1, 1) === '/')? 'index.html':'/index.html';
		}
		if (!file_exists($file)) {
			$file = './404.html';
		}
		echo file_get_contents($file);
	} else { // log in
		echo file_get_contents('./login.html');
	}
?>