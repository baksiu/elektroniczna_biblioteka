<?php
	session_start();
	mysql_connect('localhost', 'root', 'admin'); // tutaj podajemy serwer, login i haslo
	mysql_select_db('biblioteka');		
	
	if($_POST['logowanie'])
	{
		$login_type=$_POST['login'];
		$pass_type=$_POST['haslo'];
		$query = mysql_query("SELECT * FROM `pracownicy` WHERE login='$login_type'"); //wyszukuje w bazie konta o nazwie podanej przez formularz
		$row = mysql_fetch_array($query);
	}
	else
	{
		print("Coœ nie posz³o.");
	}
	
	if($row)
	{
		if($pass_type == $row['haslo']) //jesli haslo jest prawidlowe
		{
			$_SESSION['login']=$login_type;
			if($row['typ'] == 1)
			{
				header("location:mainpage_2.php");
			}
			else
			{
				header("location:mainpage.php");
			}

		}
		else
		{
			print("Nieprawid³owe has³o.");
		}
	}
	else
	{
		print("Nie ma takiego konta.");
	}
?>
		
	