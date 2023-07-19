<!DOCTYPE html>
<html>
<head>
	<title>My REST API Documentation</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    
		<nav >
		<a href="/zadanie2/rest_fe/rest.php">Naspäť</a>



	

		</nav>
	<h1>My REST API Documentation</h1>
    <h2>GET</h2>
<p>Endpoint: https://site181.webte.fei.stuba.sk/zadanie2/api/v1/</p>
<p>Description: Retrieves all data from the jedalny_listok table.</p>

<h2>POST</h2>
<p>Endpoint: https://site181.webte.fei.stuba.sk/zadanie2/api/v1/</p>
<p>Description: Creates a new row in the jedalny_listok table.</p>
<p>Parameters:</p>
<ul>
	<li>jedlo_nazov - the name of the food item (required)</li>
	<li>meno - the name of the person who added the item (required)</li>
	<li>cena - the price of the food item (required)</li>
	<li>den - the day of the week when the food item will be available (required)</li>
	<li>datum - the date when the food item will be available (required)</li>
</ul>

<h2>PUT</h2>
<p>Endpoint: https://site181.webte.fei.stuba.sk/zadanie2/api/v1/?id={id}</p>
<p>Description: Updates a row in the jedalny_listok table with the specified id.</p>
<p>Parameters:</p>
<ul>
	<li>jedlo_nazov - the name of the food item (optional)</li>
	<li>meno - the name of the person who added the item (optional)</li>
	<li>cena - the price of the food item (optional)</li>
	<li>den - the day of the week when the food item will be available (optional)</li>
	<li>datum - the date when the food item will be available (optional)</li>
</ul>

<h2>DELETE</h2>
<p>Endpoint: https://site181.webte.fei.stuba.sk/zadanie2/api/v1/?id={id}</p>
<p>Description: Deletes a row from the jedalny_listok table with the specified id.</p>
<p>Parameters:</p>
<ul>
	<li>id - the id of the row to be deleted (required)</li>
</ul>

</body>
</html>