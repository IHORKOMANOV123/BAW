<!DOCTYPE HTML>
<html>
<head>
	<title>Calculator - Directive by HTML5 UP</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<style>
		#calc-container {
			background-color: #f0f0f0;
			border: 1px solid #ccc;
			border-radius: 10px;
			padding: 20px;
			text-align: center;
			margin: 50px auto;
			width: 300px;
		}
		#calc-container form {
			text-align: left;
		}
		#calc-container input {
			background-color: #e0e0e0;
			border: 1px solid #aaa;
			border-radius: 5px;
			padding: 8px;
			margin: 5px 0;
			width: 100%;
			box-sizing: border-box;
		}
		#calc-container button {
			background-color: #28a745;
			border: none;
			border-radius: 5px;
			padding: 10px;
			color: #fff;
			cursor: pointer;
			width: 100%;
		}
	</style>
</head>
<body class="is-preload">
	<div id="header">
		<span class="logo icon fa-paper-plane"></span>
		<div class="intro">
			<h1>Cześć, aby skorzystać z kalkulatora kredytowego, musisz się zalogować</h1>
			<a href="logout.php" class="button round">Logout</a>
		</div>
	</div>
	<div id="main">
		<header class="major container medium">
			<h2>Credit Calculator</h2>
		</header>
		<div class="box alt container">
			<section class="feature left">
				<div id="calc-container">
					<form method="post" action="calc.php">
						<div>
							<label for="kwota">Loan Amount (PLN):</label>
							<input type="number" id="kwota" name="kwota" required value="{$kwota|default:''}">
						</div>
						<div>
							<label for="lat">Loan Term (years):</label>
							<input type="number" id="lat" name="lat" required value="{$lat|default:''}">
						</div>
						<div>
							<label for="procent">Interest Rate (%):</label>
							<input type="number" step="0.1" id="procent" name="procent" required value="{$procent|default:''}">
						</div>
						<button type="submit">Calculate</button>
					</form>
					{if isset($rata)}
						<div id="calc-result">
							<h3>Monthly Payment: {$rata} PLN</h3>
						</div>
					{/if}
					{if !empty($messages)}
						<div id="calc-messages">
							{foreach from=$messages item=msg}
								<p>{$msg}</p>
							{/foreach}
						</div>
					{/if}
				</div>
			</section>
		</div>
	</div>
	<footer id="footer">
		<div class="container">
			<p>&copy; Your Company. All rights reserved.</p>
		</div>
	</footer>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>
