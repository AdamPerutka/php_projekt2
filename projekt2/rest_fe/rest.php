
<!DOCTYPE html>
<html>
<head>
	<title>Read Jedalny Listok</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../style.css">

	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin: 20px 0;
		}
		table th, table td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: left;
		}
		table th {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body> 
	
		<nav >
		<div class="dropdown" >
			<a href="#">Dni na výber</a>
			<div class="dropdown-content">
		<a><button onclick="fetchListok('pondelok')">Pondelok</button></a>
		<a><button onclick="fetchListok('utorok')">Utorok</button></a>
		<a><button onclick="fetchListok('streda')">Streda</button></a>
		<a><button onclick="fetchListok('štvrtok')">Stvrtok</button></a>
    	<a><button onclick="fetchListok('piatok')">Piatok</button></a>
			</div>
		</div>	
		<a><button onclick="fetchListokT()">Cely Tyzden</button></a>
		<a><button onclick="openPopup2()">Pridať nový</button></a>
		<a href="/zadanie2/index.php">Naspäť</a>
		<a href="/zadanie2/rest_fe/documentation.php">DOKUMENTÁCIA</a>
		<a href="/zadanie2/rest_fe/client_test.php">CLIENT API TEST</a>



	

		</nav>


	
	<table id="listok-table">
		<thead>
			<tr>
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
    

	<script>

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
                            <td>${row.id}</td>
							<td>${row.den}</td>
							<td>tento tyzden</td>
							<td>${row.jedlo_nazov}</td>
							<td>${row.meno}</td>
							<td>
							${row.cena}</td>   

							<td>
							<button onclick="openPopup(${row.id})">Edit</button>
							</td>
							<td>
							<button onclick="deleteListok(${row.id})">Delete</button>
							</td>
							`;
						tbody.appendChild(tr);
                        }else if(row.den == den){
						const tr = document.createElement('tr');
						tr.innerHTML = `
							<td>${row.id}</td>
							<td>${row.den}</td>
							<td>${row.datum}</td>
							<td>${row.jedlo_nazov}</td>
							<td>${row.meno}</td>
							<td>${row.cena}</td>
							<td>
							<button onclick="openPopup(${row.id})">Edit</button>
							</td>
							<td>
							<button onclick="deleteListok(${row.id})">Delete</button>
							</td>
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
                            <td>${row.id}</td>
							<td>${row.den}</td>
							<td>tento tyzden</td>
							<td>${row.jedlo_nazov}</td>
							<td>${row.meno}</td>
							<td>${row.cena}</td>    
							<td>
							<button onclick="openPopup(${row.id})">Edit</button>
							</td> 
							<td>
							<button onclick="deleteListok(${row.id})">Delete</button>
							</td>                       `;
						tbody.appendChild(tr);
                        }else{
						const tr = document.createElement('tr');
						tr.innerHTML = `
							<td>${row.id}</td>
							<td>${row.den}</td>
							<td>${row.datum}</td>
							<td>${row.jedlo_nazov}</td>
							<td>${row.meno}</td>
							<td>${row.cena}</td>
							<td>
							<button onclick="openPopup(${row.id})">Edit</button>
							</td>
							<td>
							<button onclick="deleteListok(${row.id})">Delete</button>
							</td>

						`;
						tbody.appendChild(tr);
                        }
					});
				})
				.catch(error => console.error(error));
		}
		fetchListokT();
		function openPopup(id) {
			var popup = window.open("https://site181.webte.fei.stuba.sk/zadanie2/rest_fe/index.php?id="+ id,  "Popup", "width=300,height=300");
		}
		function openPopup2(){
			var popup = window.open("https://site181.webte.fei.stuba.sk/zadanie2/rest_fe/insert.php" ,  "Popup", "width=300,height=300");
		}

		function deleteListok(id) {
			fetch(`https://site181.webte.fei.stuba.sk/zadanie2/rest.php?id=${id}`, {
			  method: 'DELETE',
			})
			.then(response => response.json())
			.then(data => {
			  location.reload();

			})
			.catch(error => {
			  console.error(error);
			});
		}


		// fetchListok();
	</script>

</body>
</html>
