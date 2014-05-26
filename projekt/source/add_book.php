<?php
	session_start();
	if(!isset($_SESSION['login']))
	{
		header("location:index.php");
	}
	function add_books()
	{
		$con=mysql_connect('localhost', 'root', 'admin');
		mysql_select_db('biblioteka');
		
		$title = $_POST['nazwa'];
		$year = $_POST['rok'];
		$iisbn = $_POST['isbn'];
		$author = $_POST['autor'];

		$sql=mysql_query("INSERT INTO ksiazki (nazwa, autor, rok, isbn) VALUES ('$title', '$author', '$year', '$iisbn')");
	}
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
	
	if(isset($_POST['dodawanie']))
	{
		add_books();
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
		<input type="text" name="autor" value="" /><br />
		<input type="submit" value="Dodaj" name="dodawanie"/>
		</div>
		</form>
</body>
</html>