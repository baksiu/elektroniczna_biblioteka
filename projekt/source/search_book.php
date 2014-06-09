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
	
	if(isset($_POST['szukanie']))
	{
		mysql_connect('localhost', 'root', 'admin');
		mysql_select_db('biblioteka');
		$search = new searchBook();
		$search -> setDane($_POST['zapytanie'],$_POST['t_zapyt']);
		$search -> searchBooks();
	}
?>
		<form action="search_book.php" method="post">
		<div>
		zapytanie<br />
		<input type="text" name="zapytanie" value="" /><br />
		<select name="t_zapyt">
			<option value="autor">autor</option>
			<option value="rok">rok wydania</option>
			<option value="nazwa">tytul</option>
		</select>
		<input type="submit" value="Szukaj" name="szukanie"/>
		</div>
		</form>

</body>
</html>