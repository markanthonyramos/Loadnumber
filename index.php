<?php
	require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: arial;
			font-size: 18px;
		}
		body {
			background-color: #eee;
		}
		main {
			margin: 20px auto;
			width: 90vw;
			padding: 20px;
			background-color: white;
			border-radius: 5px;
		}
		form {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		form input {
			padding: 10px 15px;
			font-size: 20px;
			width: 100%;
			outline: none;
			border: 2px solid dodgerblue;
			border-radius: 5px;
		}
		form button {
			padding: 10px 15px;
			outline: none;
			border: none;
			background: dodgerblue;
			border-radius: 5px;
			margin: 5px;
			color: white;
			cursor: pointer;
		}
		.add-contact {
			margin-top: 20px;
		}
		.add-contact input:first-child {
			margin-right: 5px;
		}
		section {
			margin-top: 20px;
		}
		table {
			width: 100%;
			margin: auto;
		}
		table, td {
			border-collapse: collapse;
			border: 1px solid black;
		}
		th, td {
			padding: 5px 10px;
			text-align: center;
		}
		thead {
			background-color: #222;
			color: white;
			width: 90%;
		}
		tbody {
			display: block;
			overflow-y: scroll;
			height: 55vh;
		}
		thead, tbody tr {
			display: table;
			width: 100%;
			table-layout: fixed;
		}
		button {
			padding: 10px 15px;
			background-color: dodgerblue;
			border: none;
			border-radius: 5px;
			color: white;
			outline: none;
			cursor: pointer;
		}
		.edit-btn {
			background-color: #03C03C;
		}
		.del-btn {
			background-color: #DC143C;
		}
		.confirm {
			background-color: #03C03C;
			margin-right: 15px;
		}
		.cancel {
			background-color: #DC143C;
		}
		.confirm,
		.cancel {
			display: none;
		}
		button:focus {
			filter: brightness(80%);
		}
		#copy-input {
			position: absolute;
			left: -50%;
		}
		p {
			background-color: rgb(77, 255, 172);
			padding: 10px;
			text-align: center;
			display: none;
			font-weight: 600;
		}
		.update-contact-input,
		.update-contact-form,
		.delete-contact-form {
			display: none;
		}
		.update-contact-input {
			width: 100%;
		}
		@media (max-width: 541px) {
			* {
				font-size: 11px;
			}
			main{
				overflow: hidden;
				width: 95vw;
			}
			tbody {
				overflow-x: hidden;
			}
			td button {
			    margin: 0;
			    text-align: center;
			}
			.confirm {
			    margin: 0;
			    margin-bottom: 5px;
			}
			main input {
				font-size: 12px;
			}
			button {
				padding: 3px 8px;
				font-size: 12px;
			}
		}
	</style>
</head>
<body>
  <p>Copied!!</p>
	<main>
		<form class="search" method="POST">
			<input type="search" name="search" id="number-search" placeholder="Type your number or name here...">
			<button type="submit">Search</button>
		</form>
		<form class="add-contact" method="POST" action="add_contact.php">
			<input type="text" name="name" placeholder="Add your name here...">
			<input type="text" name="sim_number" placeholder="Add your number here...">
			<button type="submit">Add</button>
		</form>
		<section>
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Number</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					    if (isset($_POST["search"])) {
								$search = $_POST['search'];
							
								$sql = "SELECT * FROM customer_info WHERE sim_number LIKE '{$search}%' OR sim_number LIKE '%{$search}' OR name LIKE '{$search}%';";
								$result = mysqli_query($dbConnect, $sql);
							
								while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td><span>{$row['name']}</span><input type='text' data-id='{$row['id']}' value='{$row['name']}' class='update-contact-input'></td>";
								echo "<td><span>{$row['sim_number']}</span><input type='text' value='{$row['sim_number']}' class='update-contact-input'></td>";
								echo "<td><button data-id='{$row['id']}' data-number='{$row['sim_number']}' class='edit-btn'>Edit</button><button class='confirm' data-id='{$row['id']}' data-number='{$row['sim_number']}'>Confirm</button><button data-id='{$row['id']}' data-number='{$row['sim_number']}' class='cancel'>Cancel</button></td>";
								echo "<td><button data-number='{$row['sim_number']}' class='copy-btn'>Copy</button></td>";
								echo "<td><button data-id='{$row['id']}' class='del-btn'>Delete</button></td>";
								echo "</tr>";
								}
					    } else {
    						$sql = "SELECT * FROM customer_info ORDER BY name;";
    						$result = mysqli_query($dbConnect, $sql);
    
    						while ($row = mysqli_fetch_assoc($result)) {
    							echo "<tr>";
    							echo "<td><span>{$row['name']}</span><input type='text' data-id='{$row['id']}' value='{$row['name']}' class='update-contact-input'></td>";
    							echo "<td><span>{$row['sim_number']}</span><input type='text' value='{$row['sim_number']}' class='update-contact-input'></td>";
    							echo "<td><button data-id='{$row['id']}' data-number='{$row['sim_number']}' class='edit-btn'>Edit</button><button class='confirm' data-id='{$row['id']}' data-number='{$row['sim_number']}'>Confirm</button><button data-id='{$row['id']}' data-number='{$row['sim_number']}' class='cancel'>Cancel</button></td>";
    							echo "<td><button data-number='{$row['sim_number']}' class='copy-btn'>Copy</button></td>";
    							echo "<td><button data-id='{$row['id']}' class='del-btn'>Delete</button></td>";
    							echo "</tr>";
    					  }
					    }
					?>
				</tbody>
			</table>
		</section>
		<input type="text" id="copy-input">
		<form class="update-contact-form" method="POST" action="update_contact.php">
			<input type="text" name="update-id">
			<input type="text" name="updated-name">
			<input type="text" name="updated-sim_number">
		</form>
		<form class="delete-contact-form" method="POST" action="delete_contact.php">
			<input type="text" name="delete-id">
		</form>
	</main>
	<script>
		$(function () {
			$(".copy-btn").click(function () {
				const number = $(this).attr("data-number");
				const copyInput = document.querySelector("#copy-input");
				$("#copy-input").val(number);
				$("#copy-input").select();
				copyInput.setSelectionRange(0, 99999);
				document.execCommand("copy");
				$("p").show();
				setTimeout(() => $("p").hide(), 1000);
			});

			$(".edit-btn").click(function () {
				const id = $(this).attr("data-id");
				const number = $(this).attr("data-number");
				$(this).hide();
				$(this).siblings().show();
				$(`input[data-id=${id}]`).siblings().hide();
				$(`input[data-id=${id}]`).show();
				$(`input[value=${number}]`).siblings().hide();
				$(`input[value=${number}]`).show();
			});

			$(".confirm").click(function () {
				const id = $(this).attr("data-id");
				const number = $(this).attr("data-number");
				const updatedName = $(`input[data-id=${id}]`).val();
				const updatedNumber = $(`input[value=${number}]`).val();
				$("input[name=update-id]").val(id);
				$("input[name=updated-name]").val(updatedName);
				$("input[name=updated-sim_number]").val(updatedNumber);
				$(".update-contact-form").submit();
			});

			$(".cancel").click(function () {
				const id = $(this).attr("data-id");
				const number = $(this).attr("data-number");
				$(this).siblings().hide();
				$(this).hide();
				$(".edit-btn").show();
				$(`input[data-id=${id}]`).siblings().show();
				$(`input[data-id=${id}]`).hide();
				$(`input[value=${number}]`).siblings().show();
				$(`input[value=${number}]`).hide();
			});

			$(".del-btn").click(function () {
				const id = $(this).attr("data-id");
				$("input[name=delete-id]").val(id);
				$(".delete-contact-form").submit();
			});
		});
	</script>
</body>
</html>