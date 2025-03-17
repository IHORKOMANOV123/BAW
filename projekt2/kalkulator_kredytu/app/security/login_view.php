<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Logowanie</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		.container {
			width: 100%;
			max-width: 400px;
			margin: 0;
			padding: 20px;
		}
		h2 {
			margin-top: 0;
			color: #333;
		}
		form {
			margin-bottom: 20px;
		}
		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}
		input {
			width: 100%;
			padding: 8px;
			margin-bottom: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
			box-sizing: border-box;
		}
		.button {
			background-color: #4CAF50;
			color: white;
			border: none;
			padding: 10px 15px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			border-radius: 4px;
			cursor: pointer;
		}
		.messages {
			margin-top: 20px;
			padding: 10px;
			background-color: #f8d7da;
			border: 1px solid #f5c6cb;
			border-radius: 4px;
			color: #721c24;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>Logowanie</h2>

		<form action="<?php print(_APP_ROOT); ?>/app/security/login.php" method="post">
			<div>
				<label for="id_login">Login: </label>
				<input id="id_login" type="text" name="login" value="<?php out($form['login']); ?>" />
			</div>
			<div>
				<label for="id_pass">Hasło: </label>
				<input id="id_pass" type="password" name="pass" />
			</div>
			<input type="submit" value="Zaloguj" class="button"/>
		</form>

		<?php
		//wyświeltenie listy błędów, jeśli istnieją
		if (isset($messages)) {
			if (count($messages) > 0) {
				echo '<div class="messages">';
				echo '<ol>';
				foreach ($messages as $key => $msg) {
					echo '<li>'.$msg.'</li>';
				}
				echo '</ol>';
				echo '</div>';
			}
		}
		?>
	</div>
</body>
</html>