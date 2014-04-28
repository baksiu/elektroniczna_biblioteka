<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"

  "http://www.w3.org/TR/html4/strict.dtd">

<html lang="pl">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title>e-Biblioteka - logowanie</title>

</head>

<?php

  function formularz_logowanie() {

    ?>
    <form action="validation.php" method="post">
    <div>
    Login:<br />
    <input type="text" name="login" value="" /><br />
    Has³o:<br />
    <input type="password" name="haslo" value="" /><br />
    <input type="submit" value="Zaloguj" name="logowanie"/>
    </div>
    </form>
    <?php

  }

?>

<body>

<?php
	
	formularz_logowanie();	

?>

</body>

</html>