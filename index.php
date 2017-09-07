<html>
	<head>
		<meta charset="utf-8">
    </head>
	  <body>
			<style>
				
			table {border: 1px solid grey;} 

			th {border: 1px solid grey;}

			td {border: 1px solid grey;}	

				
			</style>

			<input type='button' value='Новая задача'  onclick="location.href='newtask.php';"> 
			<?php



	require("./bd/bd.php");

	if (isset($_GET['page'])){$page = intval($_GET['page']);  if ($page == 0) $page = 1; } else {$page = 1; }

	if (isset($_GET['max_rows'])){$max_rows = intval($_GET['max_rows']); } else {$max_rows = 3; }

	if (isset($_GET['sort'])){$sort = $_GET['sort'];  if ($sort != 'email' &&  $sort != 'username')$sort = 'email'; }else{ $sort = 'email';}



	$mysqli = new mysqli($bd_host, $bd_user, $bd_password, $bd_db);


	$numRows = $mysqli->query("SELECT count(*) FROM tasks")->fetch_assoc();
	$numRows = $numRows['count(*)'];

	if ($numRows > 0){
		
	$num_pages = ceil($numRows / $max_rows);

	if ($page > $num_pages)  $page = $num_pages;

	$i = ($page - 1)   * $max_rows;




	$result = $mysqli->query("SELECT * FROM tasks ORDER BY ".$sort." LIMIT ".$i.", ".$max_rows);

print <<<END
	<p>
	<table>

	<tr>

	<th>Сортировать по: </th>
	<th><input type='button' style="width:100%;" value='Имя Пользователя'  onclick="location.href='index.php?page=$page&sort=username';"> </th>
	<th><input type='button' style="width:100%;" value='E-mail'  onclick="location.href='index.php?page=$page&sort=email';"> </th>
	<th>текст задачи </th>
	<th><input type='button' style="width:100%;" value='Статус'  onclick="location.href='index.php?page=$page&sort=status';"> </th>
	</tr>
END;


	while ($row = $result->fetch_assoc()){
	 $username	= $row['username'];	
	 $email = $row['email'];
	 $textarea = $row['textarea'];	
	 $picture = $row['picture'];
	 $status = ($row['status'] == 0) ? "Не выполняется" : "Не выполняется";
					 
	$username = htmlspecialchars($username);				 
	$textarea = htmlspecialchars($textarea);				 
					 	
print <<<END
      <tr>
	  <td> <img src = '$picture' > </td>
	  <td> $username </td>
	  <td> $email </td>
	  <td> $textarea </td>
	  <td> $status </td>
	  </tr>
	  
END;
					 
					 	
					 }
					 
					 
					 
					 
		echo "</p>";
		echo "</table>";
		echo "<p> Страница: </p>";
					 
					for ($i =  max($page - 2, 0) + 1; $i <  min($num_pages - 1,$page + 1) + 2; $i++){
					 	
					   if ($i == $page)
					    {
					     echo "<a>".$i." </a>";	
					    } 	
					    else
					    {
					     echo "<a href = 'index.php?page=".$i."&sort=".$sort."'>".$i." </a>";	
					    }
					  }

					}

			?>

	</body>
	
</html>	
	