<?php
	require 'auth.php';
	if(isset($_GET['id']) && ctype_digit($_GET['id'])){
		$id = $_GET['id'];
	} else {
		header('location: FormInsert.php');
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Form Update</title>
</head>
<body>
	<?php
		readfile('navigation.tmpl.html');
		
		$name = '';
		$gender = '';
		$color = '';

		if(isset($_POST['submit'])){
			//form valication on Server side
			$validate = true;
			if(!isset($_POST['name']) || $_POST['name']===''){
				$validate = false;
			} else {
				$name = $_POST['name'];
			}
			if(!isset($_POST['gender']) || $_POST['gender']===''){
				$validate = false;
			} else {
				$gender = $_POST['gender'];
			}
			if(!isset($_POST['color']) || $_POST['color']===''){
				$validate = false; 
			} else {
				$color = $_POST['color'];
			}
			if($validate){
				$db = mysqli_connect('localhost','root','','start');
				$sql = sprintf("UPDATE users SET name='%s', gender='%s', color='%s' WHERE id=%s",
					mysqli_escape_string($db, $name),
					mysqli_escape_string($db, $gender),
					mysqli_escape_string($db, $color),
					$id);
				mysqli_query($db,$sql);
				echo '<p>User updated.</p>';
				mysqli_close($db);
			}

		} else {
			$db = mysqli_connect('localhost','root','','start');
			$sql = sprintf('SELECT * FROM users WHERE id=%s',$id);
			$result = mysqli_query($db,$sql);
			foreach ($result as $row) {
				$name = $row['name'];
				$color = $row['color'];
				$gender = $row['gender'];
			}
			mysqli_close($db);
		}
	?>

	<form method="post" action="">
		
		User name: <input type="text" name="name" value="<?php 
			echo htmlspecialchars($name);
		?>"><br>
		
		Gender:
			<input type="radio" name="gender" value="female" <?php 
				if($gender === 'female') { echo ' checked';}?>>female
			<input type="radio" name="gender" value="male" <?php 
				if($gender === 'male'){ echo ' checked';} ?>>male<br>
		
		Favorite Color:
			<select name="color">
				<option value="">Please select</option>
				<option value="blue" <?php if($color==='blue'){echo ' selected';}?> >blue</option>
				<option value="red" <?php if($color==='red'){echo ' selected';}?>>red</option>
				<option value="yellow" <?php if($color==='yellow'){echo ' selected';}?>>yellow</option>
				<option value="green" <?php if($color==='green'){echo ' selected';}?>>green</option>
			</select><br>

			<input type="submit" name="submit" value="Submit">
	
	</form>	
</body>
</html>