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
		<title>To-Do | Add Task</title>
	</head>
	<body class="bg-gray-100 min-h-screen flex items-center justify-center">
		<div class="bg-white p-8 rounded shadow-md w-96">
			<h1 class="text-2xl font-semibold mb-6">Add Task</h1>
			<form action="../process.php" method="post">
				<div class="mb-4">
					<label for="taskName" class="block text-gray-700">Task Name:</label>
					<input
						type="text"
						id="taskName"
						name="title"
						class="w-full border border-gray-300 rounded px-3 py-2" />
				</div>
				<div class="mb-4">
					<label for="taskDescription" class="block text-gray-700"
						>Task Description:</label
					>
					<textarea
						id="taskDescription"
						name="description"
						class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
				</div>
				<p class="text-l mb-2">Progress:</p>
				<select class="block w-1/2 p-1 border border-gray-400 rounded mb-4" name="progress">
					<option value="1">In Progress</option>
					<option value="2" selected>Not Yet Started</option>
					<option value="3">Done</option>
				</select>
				<input type="hidden" name="done" value="0">
				<input type="hidden" name="mode" value="add">
				<button
					type="submit"
					class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300 ease-in-out">
					Add Task
				</button>
			</form>
			<a href="../index.php" class="mt-4 block text-blue-500 hover:underline"
				>Kembali ke to-do list</a
			>
		</div>
	</body>
</html>
