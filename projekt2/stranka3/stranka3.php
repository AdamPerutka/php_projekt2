<?php

require_once('../config.z2.php');
$freefoodURL = "https://www.novavenza.sk/tyzdenne-menu";

$name = "restauracia-venza";

$redirecturl = "https://site181.webte.fei.stuba.sk/zadanie2/stranka3/stranka3.php";
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

				<a href="../stranka1/stranka1.php">Free-food</a>
				<a href="/zadanie2/stranka2/stranka2.php">Drag reštaurácia</a>
				<a href="../index.php">Naspäť</a>

            </div>
		</div>
		<a href="../stranka3/rozparsovat3.php?name=<?php echo $name?>&r_url=<?php echo $redirecturl?>">Rozparsovat</a>
		<a href="../stiahnut.php?name=<?php echo $name; ?>&url=<?php echo $freefoodURL?>&r_url=<?php echo $redirecturl?>">Stiahnut</a>
        <a href="../delete.php?name=<?php echo $name; ?>&url=<?php echo $redirecturl?>">Delete</a>
        <a> Venza Jedáleň </a>
</a>
	</nav>
</body>
</html>


