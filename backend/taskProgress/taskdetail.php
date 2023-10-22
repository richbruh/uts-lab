<?php
session_start();

if(isset($_SESSION['username'])){
	$dsn = "mysql:host=localhost;dbname=pemweb_utslabexample";
	$kunci = new PDO($dsn, "root", "");

	$sql = "SELECT * FROM tasks WHERE id = " . $_GET['id'];

	$hasil = $kunci->query($sql);
	$row = $hasil->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			rel="icon"
			href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎯</text></svg>" />
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" />
		<title>To-Do | Task Detail</title>
	</head>
	<body class="bg-gray-100 min-h-screen flex items-center justify-center">
		<div class="bg-white p-8 rounded shadow-md w-96">
			<h1 class="text-2xl font-semibold mb-6">Task Detail</h1>
			<form>
				<p class="text-l mb-2">Time Created: <?=$row['timecreated']?></p>
				<div class="mb-4">
					<label for="taskName">Task Name:</label>
					<p><?=$row['title']?></p>
				</div>
				<div class="mb-4">
					<label for="taskDescription">Task Description:</label>
					<p><?=$row['description']?></p>
				</div>
				<p class="text-l">Progress:</p>
				<p class="mb-6">
					<?php
						if($row['progress'] == 1){
							echo "In Progress";
						}else if($row['progress'] == 2){
							echo "Not Yet Started";
						}else{
							echo "Done";
						}
					?>

				</p>
				</form>
				<form action="edittask.php?id=<?=$row['id']?>" method="post" style="display: inline;">
				<button	
					type="submit"
					class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition duration-300 ease-in-out">
					Edit
				</button>
				</form>

				<form action="../process.php" method="post" style="display: inline;">
				<input type="hidden" name="id" value="<?=$row['id']?>">
				<input type="hidden" name="mode" value="delete">
				<button
					type="submit"
					onclick="return confirm('Apa anda ingin menghapus task ini?');"
					class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition duration-300 ease-in-out">
					Delete
				</button>
			<a href="../index.php" class="mt-4 block text-blue-500 hover:underline"
				>Kembali ke to-do list</a
			>
		</div>
	</body>
</html>
