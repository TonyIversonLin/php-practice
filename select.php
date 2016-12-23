<!DOCTYPE html>
<html>
<head>
	<title>PHP select</title>
</head>
<body>
	<ul>
		<?php 

			$db = mysqli_connect('localhost','root','','start');
			$sql = 'SELECT * FROM users';
			$result = mysqli_query($db, $sql);

			foreach($result as $row){
				printf('<li><span style="color: %s"> %s (%s)</span><a href="FormUpdate.php?id=%s">edit</a>
					<a href="delete.php?id=%s">delete</a></li>',
					htmlspecialchars($row['color']),
					htmlspecialchars($row['name']),
					htmlspecialchars($row['gender']),
					htmlspecialchars($row['id']),
					htmlspecialchars($row['id'])
				);
			}
			mysqli_close($db);
		?>
	</ul>
</body>
</html>