<?php
	session_start();
	if(!isset($_SESSION['login']))
	{
		header("location:index.php");
	}
	include 'classes.php';
?>
<head>
<title>e-Biblioteka</title>
</head>
<body>
<form method="post" action="mainpage.php">
<input type=submit name=logout value="Strona glowna">
</form>

<?php
	mysql_connect('localhost', 'root', 'admin');
	mysql_select_db('biblioteka');
	$showInfo = new showInfo();
	$showInfo -> setDane($_POST['ksiazka']);
	$showInfo -> infoTable();

?>

</body>
</html>