<!DOCTYPE html>
<html>
<head>
	<title>Pridat jedlo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <h1>Pridaj jedlo</h1>
	<form id="createListokForm">
		<label for="den">Den:</label>
		<input type="text" name="den" id="den" required><br>

		<label for="datum">Datum:</label>
		<input type="text" name="datum" id="datum" required><br>

		<label for="jedlo_nazov">Jedlo nazov:</label>
		<input type="text" name="jedlo_nazov" id="jedlo_nazov" required><br>

		<label for="meno">Meno:</label>
		<input type="text" name="meno" id="meno" required><br>

		<label for="cena">Cena:</label>
		<input type="text" name="cena" id="cena" required><br>

		<input type="submit" value="Create">
	</form>
    
    <script>
		
        const form = document.querySelector('#createListokForm');

		form.addEventListener('submit', (event) => {
			event.preventDefault();

			const den = document.querySelector('#den').value;
			const datum = document.querySelector('#datum').value;
			const jedlo_nazov = document.querySelector('#jedlo_nazov').value;
			const meno = document.querySelector('#meno').value;
			const cena = document.querySelector('#cena').value;

			fetch('https://site181.webte.fei.stuba.sk/zadanie2/api/v1/', {
				method: 'POST',
				body: new FormData(form),
			})
			.then(response => response.json())
			.then(data => {
				alert(data.success);
				form.reset();
			})
			.catch(error => {
				console.error(error);
				alert('Error creating jedalny listok');
			});
		});
        </script>