<?php 
session_start();

$dsn = "mysql:host=localhost;dbname=pemweb_utslabexample";
$kunci = new PDO($dsn, "root", "");

$sql = "SELECT * FROM tasks ORDER BY progress";

$hasil = $kunci->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Dopedia</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="container">
<nav class="navbar bg-neutral text-neutral-content">
  <a class="btn btn-ghost normal-case text-xl">To-DoPedia</a>

      <?php
            $loginButton = '<a
            href="../login.php"
            class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded transition duration-300 ease-in-out"
            >Login</a
            >';

            $logoutButton = '<a
            href="../../backend/processLogin.php"
            class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded transition duration-300 ease-in-out"
            >Logout</a
            >';

            if(isset($_SESSION['username'])){
              echo $logoutButton;
            }else{
              echo $loginButton;
      }?>
</nav>

<div class="container">

    <div class="flex justify-center items-center my-12">
			<div class="container mx-8 my-auto">
				<h1 class="text-4xl font-bold my-2">To-Do List</h1>

				<?php
				if(!isset($_SESSION['username'])){
					echo '<div class="alert">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <span></span>
        </div>';
				}else{
					echo "<p class='text-lg'> Selamat datang, ".$_SESSION['username']."!</p>";
				}
				?>
				<div class="flex justify-between">
					<p class="text-lg font-bold mt-4"> To-do!</p>
					<?php
					if(isset($_SESSION['username'])){
						$addTaskButton = '<a
						href="taskProcess/addtask.php"
						class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
						Add Task
						<svg
							xmlns="http://www.w3.org/2000/svg"
							fill="none"
							viewBox="0 0 24 24"
							stroke="currentColor"
							class="w-4 h-4 inline-block mb-1">
							<path
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="M12 4v16m8-8H4"></path>
						</svg>
						</a>';

						echo $addTaskButton;
					}
					?>
					
				</div>
				<table class="w-full border-collapse border-slate-500 my-4">
					<thead>
						<tr>
							<th class="border-y-2 px-4 py-2 text-left w-1/2">Task</th>
							<th class="border-y-2 px-4 py-2 text-left w-1/12">Done?</th>
							<th class="border-y-2 px-4 py-2 text-left w-1/5">Progress</th>
						</tr>
					</thead>
					<tbody>
						<?php
							while($row = $hasil->fetch(PDO::FETCH_ASSOC)){ 
								switch ($row['progress']){
									case 1:
										$rowcolor = "bg-green-100";
										break;
									case 2:
										$rowcolor = "bg-yellow-100";
										break;
									case 3:
										$rowcolor = "bg-gray-100";
										break;  
									}
						?>

						<tr class="<?= $rowcolor; ?>">
							<td class="border-y-2 px-4 py-2">
								<?php
									if(isset($_SESSION['username'])){
								?>
								<a class="hover:underline <?php if($row['progress'] == 3){ echo 'line-through'; }?>" href="taskProcess/taskdetail.php?id=<?=$row['id']?>"><?=$row['title']?></a>
								<?php
									}else{
										echo $row['title'];
									}
								?>
							</td>
							<td class="border-y-2 px-4 py-2">
								<input
									type="checkbox"
									onchange="updateDone(<?=$row['id']?>, this.checked)"
									class="form-checkbox h-5 w-5 text-blue-600" <?php if(!isset($_SESSION['username'])){ echo "disabled"; }?> <?php if($row["done"] == 1 || $row["progress"] == 3){ echo "checked"; } ?> />
							</td>
							<td class="border-y-2 px-4 py-2">
							<?php
								if(isset($_SESSION['username'])){
							?>
								
									<select class="block w-1/2 p-1 border border-gray-400 rounded" onchange="updateProgress(<?=$row['id']?>, this.value)">
										<option value="1" <?php if($row["progress"] == 1){ echo "selected"; } ?>>In Progress</option>
										<option value="2" <?php if($row["progress"] == 2){ echo "selected"; } ?>>Not Yet Started</option>
										<option value="3" <?php if($row["progress"] == 3){ echo "selected"; } ?>>Done</option>
									</select>
								
							<?php
								}else{
									switch ($row['progress']){
										case 1:
											$progress = "In Progress";
											break;
										case 2:
											$progress = "Not Yet Started";
											break;
										case 3:
											$progress = "Done";
											break;  
										}
										echo $progress;
									}
									
							?>
							</td>
						</tr>

						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>

		<script>
			function updateDone(taskId, isChecked) {
				let xhr = new XMLHttpRequest();
				xhr.open("POST", "update_done.php", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						location.reload();
					}
				};

				let data = "taskId=" + taskId + "&isChecked=" + (isChecked ? "1" : "0");
				xhr.send(data);
			}

			function updateProgress(taskId, selectedProgress) {
				let xhr = new XMLHttpRequest();
				xhr.open("POST", "update_progress.php", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						location.reload();
					}
				};

				let data = "taskId=" + taskId + "&selectedProgress=" + selectedProgress;
				xhr.send(data);
			}
		</script>
</div>
</body>
</html>