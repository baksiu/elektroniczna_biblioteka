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
	print("Zalogowany jako: ");
	print($_SESSION['login']);
	
	mysql_connect('localhost', 'root', 'admin');
	mysql_select_db('biblioteka');
	echo "<table border=2 align=center>
			<tr>
			<td>  Nazwa  </td><td> Rok wydania </td><td>  ISBN  </td><td>  Autor  </td>
			</tr>
			</table>";
	$show_book = new showBook();
	$show_book -> showBooks();
?>

</body>
</html>