<?php
	session_start();
	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
</head>
<meta charset="UTF-8">
	<title>Unidas Contigo Web Manager/Foros</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--Font-->
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!--- StyleSheet---->
	<link rel="stylesheet" href="intro.css">
<html>
<body>
<div class="login-block">
	<div class="logo"><img src="http://viaggatore.com/unidascontigo/wp-content/uploads/2015/01/logo-uc-trans.png" alt="Logo"></div>
    <h1>Login</h1>
    <form action="login.php" method="POST" name="form">
	    <input type="text" value="" placeholder="Username" id="username" name"username" title="ingresar un nombre de usuario no mayor a 10 caracteres" />
	    <input type="password" value="" placeholder="Password" id="password" name"password" />
	    <button>Submit</button>
	</form>
</div>
</body>