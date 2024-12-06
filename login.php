<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="styles/styles.css">
	<style>
		/* General Styles */
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background-color: #1e1e1e;
			color: #ffffff;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		/* Login Container */
		.login-container {
			background-color: #2a2a2a;
			border-radius: 10px;
			padding: 30px;
			width: 90%;
			max-width: 400px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
			text-align: center;
		}

		/* Header Message */
		h1 {
			margin: 0 0 20px;
			color: #00bcd4;
		}

		/* Form Styles */
		form p {
			margin: 15px 0;
			text-align: left;
		}

		form label {
			display: block;
			font-size: 14px;
			color: #bbbbbb;
		}

		form input[type="text"], 
		form input[type="password"] {
			width: 100%;
			padding: 10px;
			background-color: #1e1e1e;
			color: #ffffff;
			border: 1px solid #444;
			border-radius: 5px;
			margin-top: 5px;
		}

		form input[type="submit"] {
			background-color: #00bcd4;
			color: #ffffff;
			border: none;
			padding: 10px;
			cursor: pointer;
			font-weight: bold;
			border-radius: 5px;
			margin-top: 15px;
			width: 100%;
		}

		form input[type="submit"]:hover {
			background-color: #008c9e;
		}

		/* Status Message */
		.status-message {
			margin-bottom: 15px;
			font-size: 14px;
			padding: 10px;
			border-radius: 5px;
			text-align: center;
		}

		.status-success {
			background-color: #0f5132;
			color: #d1e7dd;
		}

		.status-error {
			background-color: #842029;
			color: #f8d7da;
		}

		/* Register Link */
		.register-link {
			margin-top: 15px;
			font-size: 14px;
			color: #00bcd4;
		}

		.register-link a {
			color: #00bcd4;
			text-decoration: none;
			font-weight: bold;
		}

		.register-link a:hover {
			color: #008c9e;
		}
	</style>
</head>
<body>
	<div class="login-container">
		<?php  
		if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
			$class = $_SESSION['status'] == "200" ? "status-success" : "status-error";
			echo "<div class='status-message {$class}'>{$_SESSION['message']}</div>";
		}
		unset($_SESSION['message']);
		unset($_SESSION['status']);
		?>
		<h1>Login Now!</h1>
		<form action="core/handleForms.php" method="POST">
			<p>
				<label for="username">Username</label>
				<input type="text" name="username" required>
			</p>
			<p>
				<label for="password">Password</label>
				<input type="password" name="password" required>
			</p>
			<input type="submit" name="loginUserBtn" value="Login">
		</form>
		<p class="register-link">Don't have an account? You may register <a href="register.php">here</a></p>
	</div>
</body>
</html>
