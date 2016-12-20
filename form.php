<!DOCTYPE html>
<html>
<head>
	<title>PHP Form</title>
</head>
<?php
	$name = '';
	$password = '';
	$comments = '';
	$gender = '';
	$tc = '';
	$color = '';
	$Languages = array();

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
		if(!isset($_POST['comments']) || $_POST['comments']===''){
			$validate = false;
		} else{
			$comments = $_POST['comments'];
		}
		if(!isset($_POST['gender']) || $_POST['gender']===''){
			$validate = false;
		} else {
			$gender = $_POST['gender'];
		}
		if(!isset($_POST['tc']) || $_POST['tc']===''){
			$validate = false;
		} else {
			$tc = $_POST['tc'];
		}
		if(!isset($_POST['color']) || $_POST['color']===''){
			$validate = false;
		} else {
			$color = $_POST['color'];
		}
		if(!isset($_POST['Languages']) || !is_array($_POST['Languages']) || count($_POST['Languages'])===0 ){
			$validate = false;
		} else {
			$Languages = $_POST['Languages'];
		}
		//process form
		if($validate){
			printf('User name: %s
				<br>Password: %s
				<br>Gender: %s
				<br>Color: %s
				<br>Languages: %s
				<br>Comments: %s
				<br>T&amp;C: %s', 
					htmlspecialchars($name),
					htmlspecialchars($password),
					htmlspecialchars($gender),
					htmlspecialchars($color),
					htmlspecialchars(implode(' ', $Languages)),
					htmlspecialchars($comments),
					htmlspecialchars($tc));
		}
	}
?>
<body>
	<form method="post" action="">
		
		User name: <input type="text" name="name" value="<?php 
			echo htmlspecialchars($name);
		?>"><br>

		Password: <input type="password" name="password" value="<?php 
			echo htmlspecialchars($password);
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
		
		Language spoken:
			<select name="Languages[]" multiple size="5">
				<option value="English" <?php if(in_array('English',$Languages)){echo ' selected';}?>>English</option>
				<option value="Chinese" <?php if(in_array('Chinese',$Languages)){echo ' selected';}?>>Chinese</option>
				<option value="French" <?php if(in_array('French',$Languages)){echo ' selected';}?>>French</option>
				<option value="Spanish" <?php if(in_array('Spanish',$Languages)){echo ' selected';}?>>Spanish</option>
				<option value="Italian" <?php if(in_array('Italian',$Languages)){echo ' selected';}?>>Italian</option>
			</select><br>

		commments: <textarea name="comments"><?php 
			echo htmlspecialchars($comments);
		?></textarea><br>

			<input type="checkbox" name="tc" value="ok" <?php 
				if($tc ==='ok') { echo ' checked';}
			?>>I accept the T&C<br>
			<input type="submit" name="submit" value="Submit">
	
	</form>
</body>
</html>