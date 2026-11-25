<?php 
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "workout_app_db";

try{
    $myDB = new PDO("mysql:host=".$dbHost.";dbname=".$dbName, $dbUser, $dbPass);
} catch(Exception $e){
    die("Error: " . $e->getMessage());
}

function GetUserData($myDB){
	$query = "SELECT * FROM users";
	$stmt = $myDB->prepare($query);
	$stmt->execute();
	$data = $stmt->fetchAll();
	return $data;
}

$userData = GetUserData($myDB);

function InsertUser($db, $data){
	$query = "INSERT INTO users (username, password) VALUES (:username, :password)";
	$stmt = $db->prepare($query);
	$stmt->execute($data);
}

	if(isset($_POST['btn_submit']) && null !== $_POST['btn_submit']){
		$userData = array();
		$userData['Username'] = $_POST['Username'];
		$userData['password'] = $_POST['Text'];

		InsertUser($myDB, $userData);
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div class="title">
        <header>ARISE</header>
    </div>
    <div class="welcome">
        <h1>Welcome Player</h1>
    </div>
	<form method="post">
		<div class="field_div">
			<label>Username</label>
			<br>
			<input type="text" name="username">
		</div>
		<div class="field_div">
			<label>Password</label>
			<br>
            <input type="text" name="password">
		</div>
		</div>
		<div class="field_div">
			<input type="submit" name="btn_submit" value="Send">
		</div>
	</form>
</body>
</html>

<style>

    body{
        background-color: black;
        background-image:     linear-gradient(to right, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.55) 50%, rgba(0, 0, 0, 0.85) 100%), url('background.jpg');
        background-size: cover;

    }

    .title{
        text-align: center;
        font-family: sans-serif;
        font-size: 50px;
        color: white;
    }

	.field_div{
		padding: 10px;
	}

    .welcome{
        color: white;
        font-family: sans-serif;
        text-align: center;
        padding-top: 40px;
    }
</style>