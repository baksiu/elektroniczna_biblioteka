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
<form method="post" action="mainpage_2.php">
<input type=submit name=logout value="Strona glowna">
</form>
<?php
	print("Zalogowany jako: ");
	print($_SESSION['login']);
	
	if(isset($_POST['dodawanie']))
	{
		mysql_connect('localhost', 'root', 'admin');
		mysql_select_db('biblioteka');
		$czytelnik = new nowy_czyt();
		$czytelnik -> setDane($_POST['imie'],$_POST['nazwisko'],$_POST['PESEL']);
		if(($czytelnik->sprCzyIstnieje()) == 0)
		{
			$czytelnik -> dodajCzyt();
		}
	}
?>
		<form action="add_reader.php" method="post">
		<div>
		imie<br />
		<input type="text" name="imie" value="" /><br />
		nazwisko<br />
		<input type="text" name="nazwisko" value="" /><br />
		PESEL<br />
		<input type="text" name="PESEL" value="" /><br />
		<input type="submit" value="Dodaj" name="dodawanie"/>
		</div>
		</form>
</body>
</html>