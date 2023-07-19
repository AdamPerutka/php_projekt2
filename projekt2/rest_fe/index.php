<!DOCTYPE html>
<html>
<head>
	<title>Zmeniť záznam</title>
</head>
<body>

	<h1>Zmeniť záznam</h1>
	<form id="update-form">
		

		<label for="den">Den:</label>
		<input type="text" id="den" name="den"><br><br>
		<label for="datum">Datum:</label>
		<input type="text" id="datum" name="datum"><br><br>
		<label for="jedlo_nazov">Jedlo Nazov:</label>
		<input type="text" id="jedlo_nazov" name="jedlo_nazov"><br><br>
		<label for="meno">Meno:</label>
		<input type="text" id="meno" name="meno"><br><br>
		<label for="cena">Cena:</label>
		<input type="text" id="cena" name="cena"><br><br>
		<button type="submit" >Update</button>
		<button onclick="window.close()"> Exit </button>
	</form>
	<script>

		const updateForm = document.getElementById('update-form');
		updateForm.addEventListener('submit', function(event) {
			event.preventDefault();

			const id = "<?php echo $_GET['id']; ?>"; // get id from URL
			const den = document.getElementById('den').value;
			const datum = document.getElementById('datum').value;
			const jedlo_nazov = document.getElementById('jedlo_nazov').value;
			const meno = document.getElementById('meno').value;
			const cena = document.getElementById('cena').value;

			fetch(`https://site181.webte.fei.stuba.sk/zadanie2/rest.php?id=${id}`, {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				body: `den=${den}&datum=${datum}&jedlo_nazov=${jedlo_nazov}&meno=${meno}&cena=${cena}`
			})
			.then(response => response.json())
			.then(data => {
				alert(data.success);
			})
			.catch(error => {
				console.error(error);
			});
		});
	</script>
</body>
</html>
