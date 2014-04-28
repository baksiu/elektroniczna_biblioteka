<?php
	session_start();
	if(!isset($_SESSION['login']))
	{
		header("location:index.php");
	}
?>

<head>
<title>e-Biblioteka</title>
</head>
<body>
<?php
	
	print("Zalogowany jako: ");
	print($_SESSION['login']);
?>
<form method="post" action="logout.php">
<input type=submit name=logout value="Wyloguj">
</form>
<form method="post" action="show_books.php">
<input type=submit name=logout value="Pokaz liste ksiazek">
</form>
<form method="post" action="add_book.php">
<input type=submit name=logout value="Dodaj ksiazke">
</form>
</body>
</html>
