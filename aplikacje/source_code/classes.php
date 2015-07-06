<?php

class showBook
{
	private $name;
	private $year;
	private $isbn;
	private $author;
	private $author_nazwisko;
	private $author_imie;
	private $author2;
	private $author3;
	private $query;
	private $result;
	private $row;

	
	function __construct()
	{
	 $this->name = null;
	 $this->year = null;
	 $this->isbn = null;
	 $this->author = null;
	 $this->author_imie = null;
	 $this->author_nazwisko = null;
	 $this->author2 = null;
	 $this->author3 = null;
	 $this->result = null;
	 $this->query = null;
	 $this->row = null;
	}
	
	function showBooks()
	{
		$this->query="SELECT * FROM ksiazki";
		$this->result=mysql_query($this->query) or die(mysql_error());
		while ($this->row=mysql_fetch_array($this->result)) 
		{
			$this->name=$this->row['nazwa']; 
			$this->year=$this->row['rok'];
			$this->isbn=$this->row['isbn']; 
			$this->author=$this->row['autor'];
			$this->author2 =  mysql_query("SELECT * FROM autor WHERE id = '$this->author'");
			$this->author3 = mysql_fetch_array($this->author2);
			$this->author_imie = $this->author3['imie'];
			$this->author_nazwisko = $this->author3['nazwisko'];
			echo "<table border=2 align=center cellpadding=10>
			<tr>
			<td>		
				<form action=extended_info.php method=post>
				<div>
				<input type=hidden name=ksiazka value=$this->isbn />
				<input type=submit value=$this->name name=info/>
				</div>
				</form>
			</td>
			<td>$this->year</td><td>$this->isbn</td><td>$this->author_imie $this->author_nazwisko</td>
			</tr>
			</table>";
		}
	}
}

class showInfo
{
	private $name;
	private $status;
	private $dates;
	private $year;
	private $isbn;
	private $author;
	private $author_nazwisko;
	private $author_imie;
	private $author2;
	private $author3;
	private $query;
	private $result;
	private $row;
	private $okres;

	
	function __construct()
	{
	 $this->name = null;
	 $this->status = null;
	 $this->okres = null;
	 $this->dates = null;	 
	 $this->year = null;
	 $this->isbn = null;
	 $this->author = null;
	 $this->author_imie = null;
	 $this->author_nazwisko = null;
	 $this->author2 = null;
	 $this->author3 = null;
	 $this->result = null;
	 $this->query = null;
	 $this->row = null;
	}
	
	function setDane($pa)
	{
		$this->isbn = $pa;
	}
	
	function infoTable()
	{
		$this->query="SELECT * FROM ksiazki WHERE isbn ='$this->isbn'";
		$this->result=mysql_query($this->query) or die(mysql_error());
		while ($this->row=mysql_fetch_array($this->result)) 
		{
			$this->name=$this->row['nazwa']; 
			$this->year=$this->row['rok'];
			$this->isbn=$this->row['isbn']; 
			$this->status=$this->row['status']; 
			$this->dates=$this->row['status_chng']; 
			$this->okres=$this->row['okres'];
			$this->author=$this->row['autor'];
			$this->author2 =  mysql_query("SELECT * FROM autor WHERE id = '$this->author'");
			$this->author3 = mysql_fetch_array($this->author2);
			$this->author_imie = $this->author3['imie'];
			$this->author_nazwisko = $this->author3['nazwisko'];
			echo "<table border=2 align=center cellpadding=10>
			<tr>
			<td>	Tytuł: </td><td>	$this->name;</td>
			</tr>
			<tr>
			<td>	Rok wydania: </td><td>$this->year</td>
			</tr>
			<tr>
			<td>	Numer ISBN: </td><td>$this->isbn</td>
			</tr>
			<tr>
			<td>	Autor: </td><td>$this->author_imie $this->author_nazwisko</td>
			</tr>
			</table>";
			if($this->status !=0)
			{
				echo"<table border=2 align=center cellpadding=10>
				<tr>
				<td>	Status: </td><td>Wypozyczona dnia: $this->dates na okres: $this->okres</td>
				</tr>
				</table>";
			}
			else
			{				
				echo"<table border=2 align=center cellpadding=10>
				<tr>
				<td>	Status: </td><td>Dostepna: 
					<form action=wypozycz.php method=post>
					<div>
						<input type=hidden name=ksiazka value=$this->isbn />
						<input type=submit value=wypozycz name=wypozycz/>
					</div>
					</form>
				</td>
				</tr>
				</table>";
			}
		}
	}
}

class searchBook
{
	private $zap;
	private $typ_zap;
	private $name;
	private $year;
	private $isbn;
	private $author;
	private $query;
	private $result;
	private $row;
	
	
	function __construct()
	{
		 $this->zap = null;
		 $this->typ_zap = null;
		 $this->name = null;
		 $this->year = null;
		 $this->isbn = null;
		 $this->author = null;
		 $this->result = null;
		 $this->query = null;
		 $this->row = null;
	}
	
	function setDane($im,$na)
	{
		 $this->zap = $im;
		 $this->typ_zap = $na;
	}
	
	function searchBooks()
	{
		$this->query="SELECT * FROM ksiazki WHERE $this->typ_zap ='$this->zap'";
		$this->result=mysql_query($this->query) or die(mysql_error());
		while ($this->row=mysql_fetch_array($this->result)) 
		{
			$this->name=$this->row['nazwa']; 
			$this->year=$this->row['rok'];
			$this->isbn=$this->row['isbn']; 
			
			echo "<table border=2 align=center cellpadding=10>
			<tr>
			<td>$this->name</td><td>$this->year</td><td>$this->isbn</td>
			</tr>
			</table>";
		}
	}
}

class nowaKsiazka
{
	private $title;
	private $author;
	private $year;
	private $isbn;
	private $czy_istnieje;
	private $query;
	private $result;	
	
	function __construct()
	{
	 $this->title = null;
	 $this->author = null;
	 $this->year = null;
	 $this->isbn = null;
	 $this->czy_istnieje = null;
	 $this->result = null;
	 $this->query = null;
	}
	
	function setDane($im,$na,$pe,$pa)
	{
	 $this->title = $im;
	 $this->author = $pa;
	 $this->year = $na;
	 $this->isbn = $pe;
	}
	function sprCzyIstnieje()
	{
		$this->query="SELECT * FROM ksiazki";
		$this->result=mysql_query($this->query) or die(mysql_error());
		while ($this->row=mysql_fetch_array($this->result)) 
		{
			if($this->row['isbn'] == $this->isbn)
			{
				return 1;
			}
		}
		return 0;
	}
	function dodajKsiazke()
	{	
		$this->query=mysql_query("INSERT INTO ksiazki (nazwa, autor, rok, isbn) VALUES ('$this->title', '$this->author', '$this->year', '$this->isbn')");
		if($this->query != NULL)
		{
			echo "Dodano ksiazke";
		}
		else
		{
			echo "Dodanie ksiazki nie powiodlo sie";
		}
	}	
}

class nowy_czyt
{
	private $imie;
	private $nazwisko;
	private $pesel;
	private $nr_czyt;
	private $czy_istnieje;
	private $query;
	private $result;	
	
	function __construct()
	{
	 $this->imie = null;
	 $this->nazwisko = null;
	 $this->pesel = null;
	 $this->nr_czyt = null;
	 $this->czy_istnieje = null;
	 $this->result = null;
	 $this->query = null;
	}
	
	function setDane($im,$na,$pe)
	{
		$this->imie = $im;
		$this->nazwisko = $na;
		$this->pesel = $pe;
	}
	function sprCzyIstnieje()
	{
		$this->query="SELECT * FROM czytelnik";
		$this->result=mysql_query($this->query) or die(mysql_error());
		while ($this->row=mysql_fetch_array($this->result)) 
		{
			if($this->row['PESEL'] == $this->pesel)
			{
				return 1;
			}
		}
		return 0;
	}
	function dodajCzyt()
	{	
		$this->query=mysql_query("INSERT INTO czytelnik (imie, nazwisko, PESEL) VALUES ('$this->imie', '$this->nazwisko', '$this->pesel')");
		if($this->query != NULL)
		{
			echo "Dodano czytelnika";
		}
		else
		{
			echo "Dodanie czytelnika nie powiodlo sie";
		}
	}	
}

class wypozyczenie
{
	private $isbn;
	private $okres;
	private $query;
	private $result;
	private $row;
	private $nr_czyt;
	
	
	function __construct()
	{
		 $this->isbn = null;
		 $this->okres = null;
		 $this->result = null;
		 $this->query = null;
		 $this->row = null;
		 $this->nr_czyt = null;
	}
	
	function setDane($im,$na,$pa)
	{
		 $this->isbn = $im;
		 $this->nr_czyt = $na;
		 $this->okres = $pa;
	}
	function checkReader()
	{
		$this->query="SELECT * FROM czytelnik";
		$this->result=mysql_query($this->query) or die(mysql_error());
		while ($this->row=mysql_fetch_array($this->result)) 
		{
			if($this->row['PESEL'] == $this->nr_czyt)
			{
				return 0;
			}
		}
		return 1;
	}
	function sprDostep()
	{
		$this->query="SELECT * FROM ksiazki WHERE isbn='$this->isbn'";
		$this->result=mysql_query($this->query) or die(mysql_error());
		while ($this->row=mysql_fetch_array($this->result)) 
		{
			if($this->row['status'] == 0)
			{
				return 0;
			}
		}
		return 1;
	}
	function rent()
	{
		$this->query=mysql_query("UPDATE ksiazki SET status='$this->nr_czyt', okres='$this->okres' WHERE isbn='$this->isbn'");
		if($this->query)
		{
			echo "Wypozyczono ksiazke\n";
		}
		else
		{
			echo "Nie wypozyczono ksiazki\n";
		}
	}
}
?>
		
