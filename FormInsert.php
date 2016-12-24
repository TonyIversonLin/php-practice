<!DOCTYPE html>
<html>
<head>
	<title>PHP Form</title>
</head>

<body>
	<?php
		readfile('navigation.tmpl.html');

		$name = '';
		$gender = '';
		$color = '';
		$password='';

		if(isset($_POST['submit'])){
			//form valication on Server side
			$validate = true;
			if(!isset($_POST['name']) || $_POST['name']===''){
				$validate = false;
			} else {
				$name = $_POST['name'];
			}
			if(!isset($_POST['password']) || $_POST['password']===''){
				$validate = false;
			} else {
				$password = $_POST['password'];
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

			//password hashing
			$hash = password_hash($password,PASSWORD_DEFAULT);

			//saving data to database
			if($validate){
				$db= mysqli_connect('localhost','root','','start');
				$sql = sprintf("INSERT INTO users (name, password ,gender, color) VALUES (
						'%s','%s','%s','%s'
					)",mysqli_escape_string($db,$name),
						 mysqli_escape_string($db,$hash),
						 mysqli_escape_string($db,$gender),
						 mysqli_escape_string($db,$color));
				mysqli_query($db, $sql);
				mysqli_close($db);
				echo '<p>User added.</p>';
			}
		}
	?>

	<form method="post" action="">
		
		User name: <input type="text" name="name" value="<?php 
			echo htmlspecialchars($name);
		?>"><br>

		Password: <input type="password" name="password"><br>
		
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

	<ul>
		<?php 
			$db= mysqli_connect('localhost','root','','start');
			$sql = 'SELECT * FROM users';
			$result = mysqli_query($db,$sql);
			foreach($result as $row){
				printf(
					'<li><span style="color: %s;">%s (%s)</span></li>',
					htmlspecialchars($row['color']),
					htmlspecialchars($row['name']),
					htmlspecialchars($row['gender'])
				);
			}
			mysqli_close($db);
		?>
	</ul>

</body>
</html>