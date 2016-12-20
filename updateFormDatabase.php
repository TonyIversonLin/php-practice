<!DOCTYPE html>
<html>
<head>
	<title>PHP Form Update</title>
</head>
<body>
		<?php
		$name = '';
		$gender = '';
		$color = '';

		if(isset($_GET['id'])){
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
</body>
</html>