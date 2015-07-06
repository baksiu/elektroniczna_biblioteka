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
	
	if(isset($_POST['dodawanie']))
	{
		$ksiazka = new nowaKsiazka();
		$ksiazka -> setDane($_POST['nazwa'],$_POST['rok'],$_POST['isbn'],$_POST['autor']);
		if(($ksiazka->sprCzyIstnieje()) == 0)
		{
			$ksiazka -> dodajKsiazke();
		}
		else
		{
			echo "<br>"
			echo "Ksiazka juz istnieje";
		}
	}
	
?>
		<form action="add_book.php" method="post">
		<div>
		tytul<br />
		<input type="text" name="nazwa" value="" /><br />
		rok<br />
		<input type="text" name="rok" value="" /><br />
		isbn<br />
		<input type="text" name="isbn" value="" /><br />
		autor<br />
		<?php
			$query = "SELECT * FROM autor"; 
			if($result = mysql_query($query)) 
			{ 
				if($success = mysql_num_rows($result) > 0) 
				{ 
				  echo "<select name='autor'>\n"; 
				  echo "<option>-- autor --</option>\n"; 
				  while ($row = mysql_fetch_array($result)) 
				  { 
					$autor_id = $row['id']; 
					$autor_imie = $row['imie']; 
					$autor_nazwisko = $row['nazwisko'];
					echo "<option value='$autor_id'>$autor_imie $autor_nazwisko</option>\n"; 
				  } 
				  echo "</select>\n"; 
				}
			}
		?>
		<input type="submit" value="Dodaj" name="dodawanie"/>
		</div>
		</form>
</body>
</html>