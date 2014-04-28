<?php
	session_start();
	if(!isset($_SESSION['login']))
	{
		header("location:index.php");
	}
	function show_books()
	{
		$query="SELECT * FROM ksiazki";
		$result=mysql_query($query) or die(mysql_error());
		while ($row=mysql_fetch_array($result)) 
		{
			$name=$row['nazwa']; 
			$year=$row['rok'];
			echo "<br>";
			echo "$name		";
			echo "$year";
		}
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
	
	mysql_connect('localhost', 'root', 'admin');
	mysql_select_db('biblioteka');
	show_books();
?>

</body>
</html>