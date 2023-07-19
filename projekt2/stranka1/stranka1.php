

<?php

require_once('../config.z2.php');

$freefoodURL = "http://www.freefood.sk/menu/#fayn-food";
$name = "free-food";
$redirecturl = urlencode("https://site181.webte.fei.stuba.sk/zadanie2/stranka1/stranka1.php");
$downloadurl = $freefoodURL;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Zadanie 2 Adam Perutka</title>
    <link rel="stylesheet" type="text/css" href="../style.css">

	
</head>

<body>
	<nav>
		
		<div class="dropdown">
			<a href="#">Stránky</a>
			<div class="dropdown-content">
               <a href="../index.php">Naspäť</a>

				<a href="../stranka2/stranka2.php">Drag reštaurácia</a>
				<a href="/zadanie2/stranka3/stranka3.php">Venza Jedáleň</a>
			 </div>
		</div>
		<a href="../stranka1/rozparsovat1.php?name=<?php echo $name?>&r_url=<?php echo $redirecturl?>">Rozparsovat</a>
		<a href="../stiahnut.php?name=<?php echo $name; ?>&r_url=<?php echo $redirecturl?>&url=<?php echo $freefoodURL?>">Stiahnut</a>
        <a href="../delete.php?name=<?php echo $name; ?>&url=<?php echo $redirecturl?>">Delete</a>
        <a> Free Food Stranka </a>
</a>
	</nav>
</body>
</html>




