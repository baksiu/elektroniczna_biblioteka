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
	print("\n");
	
	if(isset($_POST['szukanie']))
	{
		mysql_connect('localhost', 'root', 'admin');
		mysql_select_db('biblioteka');
		$rent = new wypozyczenie();
		$rent->setDane($_POST['isbn'],$_POST['nr_czyt'],$_POST['okres']);
		if($rent->checkReader() == 0)
		{
			if($rent->sprDostep() == 0)
			{
				$rent->rent();
			}
			else
			{
				echo "Ksiazka nie jest dostepna\n";
			}
		}
		else
		{
			echo "Czytelnik nie istnieje\n";
		}
	}
?>
		<form action="wypozycz.php" method="post">
		<div>
		isbn<br />
		<input type="text" name="isbn" value="" /><br />
		nr_czytelnika<br />
		<input type="text" name="nr_czyt" value="" /><br />
		<select name="okres">
			<option value=7>tydzien</option>
			<option value=14>dwa tygodnie</option>
		</select>
		<input type="submit" value="Wypozycz" name="szukanie"/>
		</div>
		</form>
</body>
</html>