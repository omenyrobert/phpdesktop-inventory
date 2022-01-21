<?php
	session_start();
	require_once 'conn.php';
	
	if(ISSET($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "SELECT COUNT(*) as count, lastname as user, mem_id as co FROM `member` WHERE `username` = :username AND `password` = :password";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		$row = $stmt->fetch();
		
		$count = $row['count'];	
		$_SESSION['user']=$row['user'];
		$_SESSION['co']=$row['co'];
		
		if($count > 0){
			// $_SESSION['id']=$stmt->bindParam(':id', $id);
			// echo "<script>alert('login successful!')</script>";
			// 	echo "<script>window.location='dashboard.php'</script>";
			header('location:dashboard.php');
		}else{
			$_SESSION['error'] = "Invalid username or password";
			header('location:index.php');
		}
	}
?>