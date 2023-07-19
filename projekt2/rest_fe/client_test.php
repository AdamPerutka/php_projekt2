<!DOCTYPE html>
<html>
    <style>
        .frame {
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid black;
  padding: 10px;
}
    </style>
<head>
<nav >
		<a href="/zadanie2/rest_fe/rest.php">Naspäť</a>
		<a href="/zadanie2/rest_fe/documentation.php">DOKUMENTÁCIA</a>



	

		</nav>
	<title>API client</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../style.css">
    <div class="frame">

	<form id="createListokForm">
		<label for="den">Den:</label>
		<input type="text" name="den" id="den"><br>

		<label for="datum">Datum:</label>
		<input type="text" name="datum" id="datum" ><br>

		<label for="jedlo_nazov">Jedlo nazov:</label>
		<input type="text" name="jedlo_nazov" id="jedlo_nazov" ><br>

		<label for="meno">Meno:</label>
		<input type="text" name="meno" id="meno" ><br>

		<label for="cena">Cena:</label>
		<input type="text" name="cena" id="cena" ><br>

		<input type="submit" value="PUT api">
	</form>
</div>
<div class="frame">

	<form id="update-form">
		
        <label for="id">id:</label>
		<input type="text" id="id" name="id"><br><br>
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
		<input type="submit" value="POST api" ></button>
</form>
</div>
<div class="frame">

<form onsubmit="event.preventDefault(); deleteListok(document.getElementById('listok-id').value);">
  <label for="listok-id">Enter ID:</label>
  <input type="number" id="listok-id" name="listok-id" required>
  <input type="submit"value="DELETE api"></input>
</form>
</div>

<div class="frame">


	
	<table id="listok-table">
		<thead>
			<tr>
            <th><button onclick="fetchListokT()">GET api</button></th>

				<th>ID</th>
				<th>Den</th>
				<th>Datum</th>
				<th>Jedlo Nazov</th>
				<th>Meno</th>
				<th>Cena</th>
				<th></th>
				<th></th>
				

			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
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

        function fetchListok(den) {
			fetch('https://site181.webte.fei.stuba.sk/zadanie2/api/v1/')
				.then(response => response.json())
				.then(listok => {
					const table = document.getElementById('listok-table');
					const tbody = table.getElementsByTagName('tbody')[0];
					tbody.innerHTML = '';
					listok.forEach(row => {
                        if(row.datum == null && row.den == den)
                        {const tr = document.createElement('tr');
						tr.innerHTML = `
                        <td></td>
                            <td>${row.id}</td>
							<td>${row.den}</td>
							<td>tento tyzden</td>
							<td>${row.jedlo_nazov}</td>
							<td>${row.meno}</td>
							<td>
							${row.cena}</td>   
							`;
						tbody.appendChild(tr);
                        }else if(row.den == den){
						const tr = document.createElement('tr');
						tr.innerHTML = `
                        <td></td>

							<td>${row.id}</td>
							<td>${row.den}</td>
							<td>${row.datum}</td>
							<td>${row.jedlo_nazov}</td>
							<td>${row.meno}</td>
							<td>${row.cena}</td>
						`;
						tbody.appendChild(tr);
                        }
					});
				})
				.catch(error => console.error(error));
		}

        function fetchListokT() {
			fetch('https://site181.webte.fei.stuba.sk/zadanie2/api/v1/')
				.then(response => response.json())
				.then(listok => {
					const table = document.getElementById('listok-table');
					const tbody = table.getElementsByTagName('tbody')[0];
					tbody.innerHTML = '';
					listok.forEach(row => {
                        if(row.datum == null)
                        {const tr = document.createElement('tr');
						tr.innerHTML = `
                        <td></td>

                            <td>${row.id}</td>
							<td>${row.den}</td>
							<td>tento tyzden</td>
							<td>${row.jedlo_nazov}</td>
							<td>${row.meno}</td>
							<td>${row.cena}</td>    
                              `;
						tbody.appendChild(tr);
                        }else{
						const tr = document.createElement('tr');
						tr.innerHTML = `
                        <td></td>

							<td>${row.id}</td>
							<td>${row.den}</td>
							<td>${row.datum}</td>
							<td>${row.jedlo_nazov}</td>
							<td>${row.meno}</td>
							<td>${row.cena}</td>

						`;
						tbody.appendChild(tr);
                        }
					});
				})
				.catch(error => console.error(error));
		}
		
		

		function deleteListok(id) {
			fetch(`https://site181.webte.fei.stuba.sk/zadanie2/rest.php?id=${id}`, {
			  method: 'DELETE',
			})
			.then(response => response.json())
			.then(data => {

			})
			.catch(error => {
			  console.error(error);
			});
		}




		const updateForm = document.getElementById('update-form');
		updateForm.addEventListener('submit', function(event) {
			event.preventDefault();

			const id = document.getElementById('id').value;
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