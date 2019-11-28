<?php
	require 'core/init.php';
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Persoonlijke pagina</title>
</head>

<body>
Succes!
<?php
	echo $_SESSION['gebruiker'];
	echo session_id();
?>
<a href="index.php">Home</a>
</body>
</html>