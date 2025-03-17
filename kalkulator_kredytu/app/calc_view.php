<?php
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Kalkulator kredytu</title>
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
		form {
			margin-bottom: 20px;
		}
		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}
		input, select {
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
		.result {
			margin-top: 20px;
			padding: 10px;
			background-color: #d4edda;
			border: 1px solid #c3e6cb;
			border-radius: 4px;
			color: #155724;
		}
		.logout {
			background-color: #dc3545;
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>Kalkulator kredytu</h2>

		<div style="margin-bottom: 15px;">
			<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="button logout">Wyloguj</a>
		</div>

		<form action="<?php print(_APP_ROOT); ?>/app/calc.php" method="post">
			<div>
				<label for="id_kwota">Kwota kredytu (zł): </label>
				<input id="id_kwota" type="number" name="kwota" value="<?php out($kwota) ?>" min="1" step="any" />
			</div>
			<div>
				<label for="id_lat">Okres kredytowania (lata): </label>
				<input id="id_lat" type="number" name="lat" value="<?php out($lat) ?>" min="1" step="1" />
			</div>
			<div>
				<label for="id_procent">Oprocentowanie (%): </label>
				<input id="id_procent" type="number" name="procent" value="<?php out($procent) ?>" min="0" step="0.1" />
			</div>
			<input type="submit" value="Oblicz" class="button" />
		</form>

		<?php
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

		<?php if (isset($rata)){ ?>
		<div class="result">
			<?php echo 'Miesięczna rata: '.$rata.' zł'; ?>
		</div>
		<?php } ?>
	</div>
</body>
</html>