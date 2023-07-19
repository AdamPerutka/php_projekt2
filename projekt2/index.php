<?php
$redirecturl = "https://site181.webte.fei.stuba.sk/zadanie2/index.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Zadanie 2 Adam Perutka</title>
    <link rel="stylesheet" type="text/css" href="style.css">

	
</head>

<body>
	<nav>
		
		<div class="dropdown">
			<a href="#">Stránky</a>
			<div class="dropdown-content">
				<a href="/zadanie2/stranka1/stranka1.php">Free-food</a>
				<a href="/zadanie2/stranka2/stranka2.php">Drag reštaurácia</a>
				<a href="/zadanie2/stranka3/stranka3.php">Venza Jedáleň</a>
			 </div>
		</div>
		<a href="/zadanie2/rozparsovat_vsetko.php?r_url=<?php echo $redirecturl?>">Rozparsovat všetko</a>
		<a href="/zadanie2/stiahnut.php?r_url=<?php echo $redirecturl?>">Stiahnuť všetko</a>
		<a href="/zadanie2/delete.php?url=<?php echo $redirecturl?>&name=jedalny">Vymazať iba jedalny listok</a>
        <a href="/zadanie2/delete.php?url=<?php echo $redirecturl?>">Vymazať všetko</a>

		<a href="/zadanie2/rest_fe/rest.php?url=<?php echo $redirecturl?>">REST API</a>

  
</a>
	</nav>
</body>
</html>
